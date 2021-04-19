<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestInterface extends Controller
{
    public function index()
    {
        return view('request.interface');
    }
}
