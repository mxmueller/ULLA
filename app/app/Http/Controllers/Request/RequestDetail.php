<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestDetail extends Controller
{
    public function index($request_id)
    {
        dd($request_id);
    }
}
