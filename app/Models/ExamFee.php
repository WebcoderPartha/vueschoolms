<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamFee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }
}
