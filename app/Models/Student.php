<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function assign_student(){
        return $this->belongsTo(AssignStudent::class, 'id', 'student_id');
    }




}
