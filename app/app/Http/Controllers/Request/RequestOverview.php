<?php

namespace App\Http\Controllers\Request;

use App\Traits\StatusValidatorTrait;
use App\Traits\ResolveTimestampTrait;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\User_stand_in;

use App\Models\Human_resource as human_resource_db_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as request_db_model;

class RequestOverview extends Controller
{

    use StatusValidatorTrait;
    use ResolveTimestampTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $requestOverviewArray = $this->buildOverviewRequest();
        return view('request.overview', compact('requestOverviewArray'));
    }

    private function buildOverviewRequest()
    {
        $overviewRequest = collect();
        $this->essentialArguments();

        foreach ($this->hmr as $hmrEntry) {
            if ($hmrEntry->creator == $this->userId) {

                $request = $this->fetchRequestModel($hmrEntry->id);

                $overviewRequest->push([
                    'status' => $this->statusValidator($request),
                    'timestamps' => [
                        'start' =>
                        $this->epochConverter($request->period->start_tstmp),
                        'end' =>
                        $this->epochConverter($request->period->end_tstmp)
                    ],
                    'arguments' => [
                        'halfday' =>
                        $request->period->half_day,
                        'id' =>
                        $request->id
                    ]
                ]);
            }
        }
        return $overviewRequest;
    }

    private function essentialArguments()
    {
        $this->userId = Auth::user()->id;
        $this->hmr = human_resource_db_model::all();
    }

    protected function fetchRequestModel($id)
    {
        return request_db_model::find($id);
    }
}
