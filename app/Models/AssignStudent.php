<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function year(){
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }

}
