<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:accounting');
    }

    public function index()
    {
        return view('dashboard');
    }
}
