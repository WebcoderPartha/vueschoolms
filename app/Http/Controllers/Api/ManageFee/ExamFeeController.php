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
        //
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
}
