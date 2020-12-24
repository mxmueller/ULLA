<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use App\Models\Comment as CommentModel;
use App\Models\Request as RequestModel;
use App\Models\Request_type as RequestTypeModel;
use App\Models\Period as PeriodModel;
use App\Models\Human_resource as Human_resourceModel;

class RequestFromSubmit extends Controller
{
    public function index(Request $request)
    {
        $this->logRequest($request);
        $this->db($request);
    }

    private function logRequest($request){
        $request = ["raw" => $request];
        $requestLog = new Logger('request');
        $requestLog->pushHandler(new StreamHandler(storage_path('logs/requests/request.log')), Logger::INFO);
        $requestLog->info('json ->', $request);
    }

    private function db($request){
        function requestComment($comment) {
            $commentModel = new CommentModel;
            $commentModel->comment = $comment;
            $commentModel->save();
            return $commentModel;
        }
        function request($commentModel, $request) {
            $requestModel = new RequestModel;
            $requestModel->request_type_id = $request->request_type_id;

            if(is_null($commentModel)){
                $requestModel->save();
            } else {
                $commentModel->comment_request()->save($requestModel);
            }

            $periodModell = new PeriodModel;
            $periodModell->start_tstmp = intval($request->_start_tstmp);
            $periodModell->end_tstmp = intval($request->_end_tstmp);
            $periodModell->half_day = $request->_half_day;
            $requestModel->period()->save($periodModell);
        }

        if ($request->request_comment === 'false') {
            request(null, $request);
        } else {
            $commentModel = requestComment($request->request_comment);
            request($commentModel, $request);
        }
    }
}
