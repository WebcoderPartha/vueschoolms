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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function allDelete(Request $request){

    }


}
