<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'name',
        'remarks',
        'ip_address',
        'mip_address',
        'cu_id',
        'mu_id',
        'status'
    ];
    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }
}
