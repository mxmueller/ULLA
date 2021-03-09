<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    // --------------------------------------------------------------------
    // ANCHOR Usage find request->comment
    // Usage: Request::find(x)->request_type

    public function request_type()
    {
        return $this->belongsTo(Request_type::class, 'request_type_id', 'id');
    }

    // --------------------------------------------------------------------
    // ANCHOR Usage find request->comment
    // Usage: Request::find(x)->comment_x

    public function request_comment()
    {
        return $this->belongsTo(Comment::class, 'request_comment_id', 'id');
    }

    public function granted_comment()
    {
        return $this->belongsTo(Comment::class, 'granted_comment_id', 'id');
    }

    public function rejected_comment()
    {
        return $this->belongsTo(Comment::class, 'rejected_comment_id', 'id');
    }

    // --------------------------------------------------------------------
    // ANCHOR Usage find request->period
    // Usage: Request::find(x)->period

    public function period()
    {
        return $this->hasOne(Period::class, 'id', 'id');
    }

    // ----------------------------------------------------------------
    // ANCHOR Usage find request->human_resource
    // Usage: Request::find(x)->human_resource

    public function human_resource()
    {
        return $this->hasOne(Human_resource::class, 'id', 'id');
    }

    public function stand_in_users()
    {
        return $this->hasOne(User_stand_in::class, 'id', 'request_stand_in_id');
    }
}
