<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestFromSubmit extends Controller
{
    public function index(Request $request)
    {
        return request()->_stand_in_collection;
    }
}
