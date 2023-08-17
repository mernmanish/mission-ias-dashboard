<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'amount',
        'email',
        'message',
        'payment_id',
        'payment_status',
    ];
}
