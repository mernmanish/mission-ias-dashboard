<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSeriesQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_id',
        'test_category',
        'question',
        'question_image',
        'option_a',
        'option_a_image',
        'option_b',
        'option_b_image',
        'option_c',
        'option_c_image',
        'option_d',
        'option_d_image',
        'option_e',
        'option_e_image',
        'answer',
        'solution',
        'solution_image'
    ];
}
