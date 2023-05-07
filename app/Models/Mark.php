<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function exam(){
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }
    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }


}
