<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSeries extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'subcategory_id',
        'test_series_name',
        'price',
        'time',
        'post_by',
        'image_link',
        'test_category',
        'no_of_question',
        'description',
        'is_support_negative',
        'negative_marks',
        'access',
        'test_type',
        'is_advance_mode',
        'status'
    ];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
    public function subcategory(){
        return $this->hasOne(SubCategory::class,'id','subcategory_id');
    }
}
