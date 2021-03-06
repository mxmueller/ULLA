<?php

namespace App\Http\Controllers\Request;

use Monolog\Logger;
use Illuminate\Http\Request;
use App\Models\User as UserModel;

use App\Mail\Request\CreationMailCreator;
use App\Mail\Request\CreationMailExecutive;

use Monolog\Handler\StreamHandler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Models\Period as PeriodModel;
use App\Models\Comment as CommentModel;
use App\Models\Request as RequestModel;
use App\Models\Request_type as RequestTypeModel;
use App\Models\User_stand_in as UserStandInModel;
use App\Models\Human_resource as HumanResourceModel;

class RequestFromSubmit extends Controller
{
    public function index(Request $request)
    {
        $this->log($request);
        $this->db($request);
    }

    private function log($request)
    {
        $request = ["raw" => $request];
        $requestLog = new Logger('request');
        $requestLog->pushHandler(new StreamHandler(storage_path('logs/requests/request.log')), Logger::INFO);
        $requestLog->info('json ->', $request);
    }

    private function db($request)
    {
        function requestComment($comment)
        {
            $commentModel = new CommentModel;
            $commentModel->comment = $comment;
            $commentModel->save();
            return $commentModel;
        }
        function request($commentModel, $request)
        {
            $requestModel = new RequestModel;
            $requestModel->rejected = false;
            $requestModel->granted = false;
            $requestModel->request_type_id = $request->request_type_id;

            if (is_null($commentModel)) {
                $requestModel->save();
            } else {
                $commentModel->comment_request()->save($requestModel);
            }

            $periodModel = new PeriodModel;
            $periodModel->start_tstmp = intval($request->start_tstmp);
            $periodModel->end_tstmp = intval($request->end_tstmp);
            $periodModel->half_day = $request->half_day;
            $periodModel->sum = $request->sum;
            $requestModel->period()->save($periodModel);

            $humanResourceModel = new HumanResourceModel;
            $requestModel->human_resource()->save($humanResourceModel);

            $humanResourceModelId = $humanResourceModel->id;

            $humanResourceEntry = HumanResourceModel::find($humanResourceModelId);
            $executive = UserModel::find($request->executive_id);
            $creator = UserModel::find($request->applicant_id);
            $humanResourceEntry->executive()->associate($executive)->save();
            $humanResourceEntry->creator()->associate($creator)->save();

            $stand_in_user_collection = $request->stand_in_collection[0];

            foreach ($stand_in_user_collection as $stand_in) {
                $standInModel = new UserStandInModel;
                $standInModel->request_stand_in_id = $requestModel->id;
                $standInModel->user_id = $stand_in['name'];
                $standInModel->over_handing_tstmp = $stand_in['timestamp'];
                $standInModel->save();
            }

            echo $requestModel->id;
            
            // Success Mail Creator
            Mail::to($creator->email)->send(new CreationMailCreator($creator->name, $requestModel->id));            
        
            // Success Mail Executive
            Mail::to($executive->email)->send(new CreationMailExecutive($creator->name, $executive->name, $requestModel->id));            
        }

        if ($request->request_comment === 'false') {
            request(null, $request);
        } else {
            $commentModel = requestComment($request->request_comment);
            request($commentModel, $request);
        }
    }
}
