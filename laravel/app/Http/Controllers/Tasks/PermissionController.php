<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class PermissionController extends Controller
{
    public function index()
    {

        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('tasks.permission', compact('users'), compact('roles'));
    }
}
