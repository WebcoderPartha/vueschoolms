<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyFee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }
    public function month(){
        return $this->belongsTo(Month::class, 'month_id', 'id');
    }
    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

}
