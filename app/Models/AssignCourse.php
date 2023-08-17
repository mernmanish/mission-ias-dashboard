<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobile',
        'course_id',
        'amount',
        'join_date',
        'expire_date',
        'status',
        'remarks'
    ];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
