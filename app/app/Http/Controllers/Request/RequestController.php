<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Role;
use App\Models\Request_type;

class RequestController extends Controller
{
    public function index()
    {
        $executives = $this->Executives();
        $stand_ins = $this->StandIn();
        $request_types = $this->Types();

        return view('request.interface', [
            'executives' => $executives,
            'stand_ins' => $stand_ins,
            'request_types' => $request_types
        ]);
    }

    private function Types() {
        $types = Request_type::all();
        return $types;
    }

    private function StandIn()
    {
        $staff = User::whereRoleIs('staff')->get();
        $accounting = User::whereRoleIs('accounting')->get();
        $executives = User::whereRoleIs('executive')->get();
        $admin = User::whereRoleIs('admin')->get();

        $stand_in_user_collection = new Collection;
        $stand_in_user_collection = $stand_in_user_collection->merge($accounting);
        $stand_in_user_collection = $stand_in_user_collection->merge($executives);
        $stand_in_user_collection = $stand_in_user_collection->merge($admin);
        $stand_in_user_collection = $stand_in_user_collection->merge($staff);

        return $stand_in_user_collection;
    }

    private function Executives()
    {
        return User::whereRoleIs('executive')->get();
    }
}
