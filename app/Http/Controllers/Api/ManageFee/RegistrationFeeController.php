<?php

namespace App\Http\Controllers\Api\ManageFee;

use App\Http\Controllers\Controller;
use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RegistrationFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RegistrationFee::with('year')->select('year_id')->groupBy('year_id')->orderBy('id', 'DESC')->get();
        return Response::json($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $countClass = count($request->class_id);

        for ($i = 0; $i < $countClass; $i++){
            RegistrationFee::create([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i],
            ]);
        }

        return Response::json('Data inserted successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = RegistrationFee::with('year', 'student_class')->where('year_id', $id)->get();
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        RegistrationFee::where('year_id')->delete();

        $countClass = count($request->class_id);

        for ($i = 0; $i < $countClass; $i++){
            RegistrationFee::where('year_id', $id)->create([
                'year_id' => $request->year_id,
                'class_id' => $request->class_id[$i],
                'amount' => $request->amount[$i],
            ]);
        }

        return Response::json('Data inserted successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RegistrationFee::where('year_id', $id)->delete();

        return Response::json('Data deleted successfully!');
    }

    public function allDelete(Request $request){

    }
}
