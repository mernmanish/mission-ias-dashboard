<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'category_id',
        'subcategory_id',
        'writer_name',
        'pdf_title',
        'price',
        'access',
        'pdf_file',
        'description',
        'image_link',
        'download_option',
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
