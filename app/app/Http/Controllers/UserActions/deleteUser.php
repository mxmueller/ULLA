<?php

namespace App\Http\Controllers\UserActions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class deleteUser extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index(Request $deleteRequest)
    {
        User::find($deleteRequest->user_id)->delete();
        return Redirect('/permission-board');
    }
}
