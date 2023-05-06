<?php

namespace App\Http\Controllers\Api\ManageMark\GradeManage;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Grade::orderBy('id', 'ASC')->get();
        return Response::json($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Grade::create([
            'grade_name' => $request->grade_name,
            'grade_point' => $request->grade_point,
            'start_mark' => $request->start_mark,
            'end_mark' => $request->end_mark
        ]);

        return Response::json('Data Added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Grade::find($id);
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Grade::where('id', $id)->update([
            'grade_name' => $request->grade_name,
            'grade_point' => $request->grade_point,
            'start_mark' => $request->start_mark,
            'end_mark' => $request->end_mark
        ]);

        return Response::json('Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Grade::find($id)->delete();

        return Response::json('Data deleted successfully!');
    }
}
