<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;
    protected $fillable = [
        'test_id',
        'user_id',
        'attempt_time',
        'question_id',
        'answer',
        'correct_answer',
        'status'
    ];
}
