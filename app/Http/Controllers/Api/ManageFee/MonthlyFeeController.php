<?php

namespace App\Http\Controllers\Api\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\MonthlyFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class MonthlyFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MonthlyFee::with('year', 'month')->select('year_id', 'month_id')->groupBy(['year_id', 'month_id'])->get();
        return Response::json($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $countClass = count($request->class_id);

        for ($i = 0; $i < $countClass; $i++){

            MonthlyFee::create([
                'year_id' => $request->year_id,
                'month_id' => $request->month_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i],
            ]);

        }

        return Response::json('Inserted data successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function showByYearMonth($year, $month){

        $data = MonthlyFee::with('year', 'month', 'student_class')->where([
            'year_id' => $year,
            'month_id' => $month
        ])->get();

        return Response::json($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function updateByYearMonth(Request $request, $year, $month){

        MonthlyFee::where([
            'year_id' => $year,
            'month_id' => $month
        ])->delete();

        $countClass = count($request->class_id);

        for ($i = 0; $i < $countClass; $i++){

            MonthlyFee::create([
                'year_id' => $request->year_id,
                'month_id' => $request->month_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i],
            ]);

        }

        return Response::json('updated data successfully!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function  deleteByYearMonth($year, $month){

        MonthlyFee::where([
            'year_id' => $year,
            'month_id' => $month
        ])->delete();

        return Response::json('Deleted data successfully!', 200);


    }

    public function allDelete(Request $request){



    }


}
