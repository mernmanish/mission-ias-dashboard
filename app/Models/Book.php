<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_title',
        'book_price',
        'book_sale_price',
        'book_link',
        'image_link',
        'description',
        'book_pdf',
        'status'
    ];
}
