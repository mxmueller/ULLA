<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestInterface extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('role:staff');
    // }

    public function index()
    {
        return view('request.interface');
    }
}
