<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\RequestDetail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\Request\GrantedMailCreator;
use App\Mail\Request\RejectedMailCreator;
use App\Mail\Request\InfoMailAccounting;

use DateTime;

use App\Models\Request as RequestModel;
use App\Models\User as UserModel;
use App\Models\Comment as CommentModel;
use App\Models\Role as LaratrustRoleModel;

use Spatie\CalendarLinks\Link;

use App\Traits\ResolveTimestampTrait;

class RequestDecision extends Controller
{

    use ResolveTimestampTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        // Load same collection as detail views.
        // Valid request->id and usergroup: executive has
        // to be given.
        $this->requestDetailClass = new RequestDetail;
        $this->requestDecisionCollection = $this->requestDetailClass->descision($id);

        $details = $this->requestDecisionCollection;

        return view('request.decision', compact('details'));
    }

    public function descisionSubmit(request $descision)
    {
        if (!is_null($descision->radio) && $descision->radio == "granted")
            $this->changeRequestToGranted($descision->comment, $descision->id);

        if (!is_null($descision->radio) && $descision->radio == "rejected")
            $this->changeRequestToRejected($descision->comment, $descision->id);

        return Redirect('/request/assigned');
    }

    private function changeRequestToGranted($comment, $request)
    {
        $grantedRequestModel = RequestModel::findOrFail($request);
        $grantedRequestModel->granted = 1;
        $grantedRequestModel->rejected = 0;

        if (!is_null($comment)) {
            $commentRelation = $this->buildCommentRelation($comment);
            $commentRelation->comment_granted()->save($grantedRequestModel);
        } else {
            $grantedRequestModel->save();
        }

        $this->accountingMail($grantedRequestModel);
        $this->grantedMail($grantedRequestModel);
    }

    private function changeRequestToRejected($comment, $request)
    {
        $rejectRequestModel = RequestModel::findOrFail($request);
        $rejectRequestModel->granted = 0;
        $rejectRequestModel->rejected = 1;

        if (!is_null($comment)) {
            $commentRelation = $this->buildCommentRelation($comment);
            $commentRelation->comment_rejected()->save($rejectRequestModel);
        } else {
            $rejectRequestModel->save();
        }

        $this->rejectedMail($rejectRequestModel);
    }

    protected function buildCommentRelation($comment)
    {
        $commentRelationModel = new CommentModel;
        $commentRelationModel->comment = $comment;
        $commentRelationModel->save();
        return $commentRelationModel;
    }

    private function grantedMail($requestModel) 
    {   
        $this->requestPeriods = $requestModel->period;

        $from = DateTime::createFromFormat('d.m.Y', $this->epochConverter($this->requestPeriods->start_tstmp));
        $to = DateTime::createFromFormat('d.m.Y', $this->epochConverter($this->requestPeriods->end_tstmp));

        $link = Link::create('🏝 Urlaub #' . $requestModel->id . ' | Atrivio ULLA', $from, $to)
            ->description('https://ulla.atrivio.net');

        // Generate a data uri for an ics file (for iCal & Outlook)
        $ics = $link->ics();

        // google calendar
        $google = $link->google();
        
        $creatorId = $requestModel->human_resource->creator;
        $creatorModel = UserModel::find($creatorId);
    
        Mail::to($creatorModel->email)->send(new GrantedMailCreator($creatorModel->name, $ics, $google, $requestModel->id));            
    }

    private function rejectedMail($requestModel)
    {
        $creatorId = $requestModel->human_resource->creator;
        $creatorModel = UserModel::find($creatorId);

        Mail::to($creatorModel->email)->send(new RejectedMailCreator($creatorModel->name, $requestModel->id));            
    }

    private function accountingMail($requestModel)
    {
        function delayedSubmit($searchQuery, $requestId, $accountingModel, $creatorModel, $executiveModel) 
        {
            Mail::to($accountingModel->email)->send(new InfoMailAccounting(
                $searchQuery, $requestId, $accountingModel->name, $creatorModel->name, $executiveModel->name));            
        }

        function buildSearchQuery($creatorId) 
        {
            return bin2hex(rtrim('desc:all:'.$creatorId.':any', '?'));
        }

        // Role "1" = Accounting
        $this->accountingModel = LaratrustRoleModel::where('id','=','1')->first(); 

        $creatorId = $requestModel->human_resource->creator;
        $creatorModel = UserModel::find($creatorId);

        $executiveId = $requestModel->human_resource->executive;
        $executiveModel = UserModel::find($executiveId);

        $requestSearchQuery = buildSearchQuery($creatorId);

        foreach ($this->accountingModel->users as $accountingUserModel) 
        {
            delayedSubmit(
                $requestSearchQuery,
                $requestModel->id,
                $accountingUserModel,
                $creatorModel,
                $executiveModel
            );  
            sleep(0.5);
        }
    }
}
