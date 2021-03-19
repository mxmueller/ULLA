<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Request\RequestDetail;
use Illuminate\Http\Request;

use App\Models\Request as RequestModel;
use App\Models\Comment as CommentModel;

class RequestDecision extends Controller
{
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
    }

    protected function buildCommentRelation($comment)
    {
        $commentRelationModel = new CommentModel;
        $commentRelationModel->comment = $comment;
        $commentRelationModel->save();
        return $commentRelationModel;
    }
}
