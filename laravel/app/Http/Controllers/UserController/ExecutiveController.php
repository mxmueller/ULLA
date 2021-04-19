<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExecutiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:executive');
    }

    public function index()
    {
        return view('dashboard');
    }
}
