<?php

namespace App\Http\Controllers\Api\ManageMark\MarkEntry;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Grade;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MarkController extends Controller
{

    public function SearchMarkStudent(Request $request){

        $data = AssignStudent::with('student', 'student_class', 'year')->where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id,
        ])->orderBy('id', 'DESC')->get();

        return Response::json($data);

    }

    public function storeMark(Request $request){

        foreach ($request->storeMark as $value){


            $checkMark = Mark::where([
                'year_id' => $value['year_id'],
                'class_id' => $value['class_id'],
                'subject_id' => $value['subject_id'],
                'student_id' => $value['student_id'],
                'exam_type_id' => $value['exam_type_id'],
            ])->first();

            if (!$checkMark){

//                $grade = Grade::where([
//                    ['start_mark', '<=', $value['mark']],
//                    ['end_mark', '>=', $value['mark']]
//                ])->first();
                $point = Grade::where('start_mark', '<=', $value['mark'])->where('end_mark', '>=', $value['mark'])->first();
                Mark::create([
                    'year_id' => $value['year_id'],
                    'class_id' => $value['class_id'],
                    'subject_id' => $value['subject_id'],
                    'student_id' => $value['student_id'],
                    'exam_type_id' => $value['exam_type_id'],
                    'grade_point' => $point->grade_point,
//                    'grade_point' => 1,
                    'mark' => $value['mark'],
                ]);
            }else{

                $point = Grade::where('start_mark', '<=', $value['mark'])->where('end_mark', '>=', $value['mark'])->first();

                Mark::where([
                    'year_id' => $value['year_id'],
                    'class_id' => $value['class_id'],
                    'subject_id' => $value['subject_id'],
                    'student_id' => $value['student_id'],
                    'exam_type_id' => $value['exam_type_id'],
                ])->update([
                    'year_id' => $value['year_id'],
                    'class_id' => $value['class_id'],
                    'subject_id' => $value['subject_id'],
                    'student_id' => $value['student_id'],
                    'exam_type_id' => $value['exam_type_id'],
                    'grade_point' => $point->grade_point,
//                    'grade_point' => 1,
                    'mark' => $value['mark'],
                ]);
            }
        }

        return Response::json('Mark Added successfully');
        
    } // End Method

}
