<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comment as CommentModel;
use App\Models\Request as RequestModel;
use App\Models\Request_type as RequestTypeModel;
use App\Models\Period as PeriodModel;
use App\Models\User as UserModel;
use App\Models\User_stand_in as UserStandInModel;
use App\Models\Human_resource as HumanResourceModel;
class RequestView extends Controller
{
    public function index(Request $request)
    {

        $id = $request->id;

        $requestModel = RequestModel::find($id);

        $requestComment = $requestModel->request_comment;

        $requestType = $requestModel->request_type;

        $requestPeriod = $requestModel->period;

        $requestHumaneResource = $requestModel->human_resource;

        $requestStandIn = $requestModel->stand_in_users;

        dd(
            $requestModel,
            $requestComment,
            $requestType,
            $requestPeriod,
            $requestHumaneResource
        );


        // dd($key);
        return view('request.view', ['response' => 'Leider konnte kein Eintrag gefunden werden']);
    }
}
