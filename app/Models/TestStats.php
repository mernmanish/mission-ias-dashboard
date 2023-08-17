<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'user_id',
        'attempt_time',
        'total_attempt',
        'correct_answer',
        'total_question',
        'wrong_answer',
        'not_attempt',
        'negative_marks',
        'overall_score',
        'accuracy',
        'status',
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
