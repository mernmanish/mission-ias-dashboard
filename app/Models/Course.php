<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course_type_id',
        'image',
        'whats_app_link',
        'syllabus',
        'duration',
        'course_fee',
        'discount_fee',
        'description',
        'status',
    ];
    public function courseType(){
        return $this->hasOne(CourseType::class,'id','course_type_id');
    }
}
