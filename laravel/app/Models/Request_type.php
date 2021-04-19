<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_type extends Model
{
    use HasFactory;

    // --------------------------------------------------------------------
    // ANCHOR Usage find request->comment
    // Usage: Request_type::find(x)->request_object

    public function request_object()
    {
        return $this->hasOne(Request::class, 'request_type_id', 'id');
    }
}
