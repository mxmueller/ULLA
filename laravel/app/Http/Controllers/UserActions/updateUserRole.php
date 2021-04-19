<?php

namespace App\Http\Controllers\UserActions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class updateUserRole extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $from_data)
    {
        $requested_user = User::find($from_data->input('user_id'));
        $requested_role = Role::find($from_data->input('new_user_role'))->name;
        $requested_current_role = $requested_user->roles;

        $requested_user->detachRole($requested_current_role[0]->name);
        $requested_user->attachRole($requested_role);

        return Redirect('/permission-board');
    }
}
