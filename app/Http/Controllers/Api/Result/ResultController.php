<?php

namespace App\Http\Controllers\Api\Result;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Grade;
use App\Models\Mark;
use App\Models\Student;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function SearchAcademicTranscript(Request $request){


        $data['student'] = Student::where('id_number', $request->id_number)->first();
        $data['assign_student'] = AssignStudent::with('year', 'group')->where('student_id',  $data['student']->id)->first();
        $data['grade'] = Grade::orderBy('id', 'ASC')->get();

        $checkFail = Mark::where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id,
            'exam_type_id' => $request->exam_type_id,
            'student_id' =>    $data['student']->id,
            ['mark', '<=', 32]
        ])->count();

        if (!$checkFail){

            $data['marks'] = Mark::with('subject')->where([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'exam_type_id' => $request->exam_type_id,
                'student_id' => $data['student']->id,
            ])->get();
            return response()->json($data);

        }else{
            return response()->json('Fail');
        }



    }

}
