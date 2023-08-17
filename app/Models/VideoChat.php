<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'user_id',
        'message',
        'status'
    ];
    public function video(){
        return $this->hasOne(Video::class,'id','video_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
