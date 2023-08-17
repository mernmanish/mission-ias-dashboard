<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'news_title',
        'date',
        'time',
        'image_link',
        'description',
        'status'
    ];
}
