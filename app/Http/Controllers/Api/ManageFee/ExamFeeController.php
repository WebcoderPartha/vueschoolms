<?php

namespace App\Http\Controllers\Api\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\ExamFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExamFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ExamFee::with('year', 'exam')->select('exam_type_id', 'year_id')->groupBy(['year_id', 'exam_type_id'])->get();
        return Response::json($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $classCount = count($request->class_id);

        for ($i = 0; $i < $classCount; $i++){

            ExamFee::create([
                'year_id' => $request->year_id,
                'exam_type_id' => $request->exam_type_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i],
            ]);

        }

        return Response::json('Inserted data successfully!');
    }

    /**
     * Display the specified resource.
     */

    public function ExamFeeShowByYear($year, $exam){

        $data = ExamFee::with('year', 'exam', 'student_class')->where([
            'year_id' => $year,
            'exam_type_id' => $exam
        ])->get();

        return Response::json($data);
    }

    public function updateByYearExam(Request $request, $year, $exam){

        ExamFee::where([
            'year_id' => $year,
            'exam_type_id' => $exam
        ])->delete();

        $countClass = count($request->class_id);

        for ($i = 0; $i < $countClass; $i++){

            ExamFee::create([
                'year_id' => $request->year_id,
                'exam_type_id' => $request->exam_type_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i],
            ]);

        }

        return Response::json('updated data successfully!', 200);
    }





    public function deleteByYearExam(string $year, $exam){


        ExamFee::where([
            'year_id' => $year,
            'exam_type_id' => $exam
        ])->delete();

        return Response::json('Deleted data successfully!', 200);
    }


    public function allSelectedDelete(Request $request){


        $countClass = count($request->checkBox);

        for ($i = 0; $i < $countClass; $i++){

            ExamFee::where([
                'year_id' => $request->checkBox[$i]['year_id'],
                'exam_type_id' => $request->checkBox[$i]['exam_type_id'],
            ])->delete();

        }

        return Response::json('Deleted data successfully!', 200);
    }



}
