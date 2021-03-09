<?php

namespace App\Http\Controllers\Request;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\User_stand_in;

use App\Models\Human_resource as human_resource_db_model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as request_db_model;

use Illuminate\Support\Facades\Storage;


class RequestOverview extends Controller
{

    public function index()
    {
        $overview = $this->overview();

        dd($overview);

        return view('request.overview', compact('overview'));
    }

    private function overview()
    {

        $user_id = Auth::user()->id;
        $human_resource = human_resource_db_model::all();
        $overview_collection = collect();

        function getStatus($request_model)
        {
            $request_overview_status_json = Storage::disk('local')->get('json/request_overview_status_svg.json');
            $request_overview_status_json_decode = json_decode($request_overview_status_json, true);
            if ($request_model->granted == 0 && $request_model->rejected == 0)
                return $request_overview_status_json_decode['profile_pending'];
            if ($request_model->granted == 1 && $request_model->rejected == 0)
                return $request_overview_status_json_decode['profile_granted'];
            if ($request_model->granted == 0 && $request_model->rejected == 1)
                return $request_overview_status_json_decode['profile_denied'];
        }

        foreach ($human_resource as $human_resource_entry) {
            if ($human_resource_entry->creator == $user_id) {

                $id = $human_resource_entry->id;

                $status_collection = getStatus(request_db_model::find($id));
                $period_modell = request_db_model::find($id)->period;

                $overview_collection->push([
                    'status_array' => $status_collection,
                    'timestamp_start' => $period_modell->start_tstmp,
                    'timestamp_end' => $period_modell->end_tstmp,
                    'halfday_bool' => $period_modell->half_day
                ]);
            }
        }


        $overview_collection->all();
        return $overview_collection;
    }
}
