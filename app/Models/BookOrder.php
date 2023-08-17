<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookOrder extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'book_id',
        'full_address',
        'land_mark',
        'pin_code',
        'state',
        'city',
        'latitude',
        'longitude',
        'order_status',
        'payment_mode',
        'payment_status'
    ];
}
