<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_stand_in extends Model
{
    use HasFactory;

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_stand_in_id', 'id');
    }

    public function stand_in_users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
