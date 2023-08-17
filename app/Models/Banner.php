<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'banner_title',
        'image_link',
        'status'
    ];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
