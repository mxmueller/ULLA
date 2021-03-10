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

    public function index()
    {
        $requestOverviewArray = $this->BuildRequestOverviewArray();
        return view('request.overview', compact('requestOverviewArray'));
    }

    private function BuildRequestOverviewArray()
    {
        $OverviewRequest = collect();
        $this->EssentialArguments();


        foreach ($this->hmr as $hmrEntry) {
            if ($hmrEntry->creator == $this->userId) {

                $request = $this->FetchRequestModel($hmrEntry->id);

                $OverviewRequest->push([
                    'status' => $this->StatusValidator($request),
                    'timestamps' => [
                        'start' =>
                        $this->EpochConverter($request->period->start_tstmp),
                        'end' =>
                        $this->EpochConverter($request->period->end_tstmp)
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
        return $OverviewRequest;
    }

    private function EssentialArguments()
    {
        $this->userId = Auth::user()->id;
        $this->hmr = human_resource_db_model::all();
    }

    protected function FetchRequestModel($id)
    {
        return request_db_model::find($id);
    }
}
