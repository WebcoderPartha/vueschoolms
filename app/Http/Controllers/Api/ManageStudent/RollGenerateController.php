<?php

namespace App\Http\Controllers\Api\ManageStudent;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RollGenerateController extends Controller
{

    public function SearchYearClassRollGenStudent($year, $class){
//        return $year;
        $data = AssignStudent::with('student', 'year', 'student_class', 'group', 'shift')->where([
            'year_id' => $year,
            'class_id' => $class
        ])->orderBy('id', 'desc')->get();

        return Response::json($data);
    }

    public function updateRollGenerate(Request $request){

        for ($i = 0; $i < count($request->roll_generate); $i++){
            AssignStudent::where('student_id', $request->roll_generate[$i]['student_id'])->update([
                'roll_number' => $request->roll_generate[$i]['roll_number']
            ]);
        }

        return Response::json('Roll Generate Successfully!');

    }


}
