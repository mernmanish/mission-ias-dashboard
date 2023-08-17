<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoChatReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'video_id',
        'user_id',
        'sender_id',
        'message',
        'status'
    ];
}
