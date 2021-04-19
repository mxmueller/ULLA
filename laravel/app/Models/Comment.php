<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // ----------------------------------------------------------------
    // ANCHOR Usage find Comment->comment_x
    // Usage: Comment::find(x)->comment_x

    public function comment_request()
    {
        return $this->hasOne(Request::class, 'request_comment_id', 'id');
    }

    public function comment_granted()
    {
        return $this->hasOne(Comment::class, 'granted_comment_id', 'id');
    }

    public function comment_rejected()
    {
        return $this->hasOne(Comment::class, 'rejected_comment_id', 'id');
    }
}
