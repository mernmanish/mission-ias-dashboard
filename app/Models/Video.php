<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'category_id',
        'subcategory_id',
        'video_title',
        'video_link',
        'source_type',
        'image_link',
        'access',
        'status'
    ];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
    public function subcategory(){
        return $this->hasOne(SubCategory::class,'id','subcategory_id');
    }
}
