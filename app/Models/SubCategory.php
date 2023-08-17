<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'category_id',
        'name',
        'status'
    ];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }
}
