<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function exam(){
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }

}
