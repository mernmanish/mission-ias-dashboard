<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsto('App\Models\State');
    }
    public function dist()
    {
        return $this->belongsto('App\Models\District');
    }
    public function city()
    {
        return $this->belongsto('App\Models\City');
    }

}
