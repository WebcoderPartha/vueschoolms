<?php

namespace App\Http\Controllers\Api\ManageStudent;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamFee;
use App\Models\ExamType;
use App\Models\MonthlyFee;
use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FeePayController extends Controller
{
    public function SearchRegistrationFeePayStudent(Request $request){
        $data['students'] = AssignStudent::with('student', 'student_class', 'year', 'group')->where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id
        ])->orderBy('id', 'desc')->get();

        $data['registration_fee'] = RegistrationFee::where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id
        ])->first();

        return Response::json($data);

    }

    public function getRegistrationPaySlipByID($year, $class, $student){
        $data['students'] = AssignStudent::with('student', 'student_class', 'year', 'group')->where([
            'year_id' => $year,
            'class_id' => $class,
            'student_id' => $student
        ])->first();

        $data['registration_fee'] = RegistrationFee::where([
            'year_id' => $year,
            'class_id' => $class,
        ])->first();

        return Response::json($data);

    }


    public function SearchMonthlyFeePayStudent(Request $request){
        $data['students'] = AssignStudent::with('student', 'student_class', 'year', 'group', 'shift')->where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id
        ])->orderBy('id', 'desc')->get();

        $data['monthly_fee'] = MonthlyFee::with('month')->where([
            'year_id' => $request->year_id,
            'month_id' => $request->month_id,
            'class_id' => $request->class_id
        ])->first();

        return Response::json($data);

    }

    public function getMonthlyPaySlipByID($year, $month, $class, $student){
        $data['students'] = AssignStudent::with('student', 'student_class', 'year', 'group')->where([
            'year_id' => $year,
            'class_id' => $class,
            'student_id' => $student
        ])->first();

        $data['monthly_fee'] = MonthlyFee::with('month')->where([
            'year_id' => $year,
            'month_id' => $month,
            'class_id' => $class
        ])->first();

        return Response::json($data);

    }


    public function SearchExamFeePayStudent(Request $request){
        $data['students'] = AssignStudent::with('student', 'student_class', 'year', 'group', 'shift')->where([
            'year_id' => $request->year_id,
            'class_id' => $request->class_id
        ])->orderBy('id', 'desc')->get();

        $data['exam'] = ExamFee::with('exam')->where([
            'year_id' => $request->year_id,
            'exam_type_id' => $request->exam_type_id,
            'class_id' => $request->class_id
        ])->first();

        return Response::json($data);

    }

    public function getExamPaySlipByID($year, $exam, $class, $student){
        $data['students'] = AssignStudent::with('student', 'student_class', 'year', 'group', 'shift')->where([
            'year_id' => $year,
            'class_id' =>$class,
            'student_id' => $student
        ])->first();

        $data['exam'] = ExamFee::with('exam')->where([
            'year_id' => $year,
            'exam_type_id' => $exam,
            'class_id' => $class
        ])->first();

        return Response::json($data);
    }


}
