<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AssignSubject::with('student_class')->select('class_id')->groupBy('class_id')->orderBy('class_id', 'DESC')->get();

        return Response::json($data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        for($i = 0; $i < count($request->subject_id); $i++){
            AssignSubject::create([
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id[$i]
            ]);
        }

        return Response::json('Assign subject added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = AssignSubject::with('student_class', 'subject')->where('class_id', $id)->get();
        return Response::json($data, 200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Delete old data
        AssignSubject::where('class_id', $id)->delete();

        for($i = 0; $i < count($request->subject_id); $i++){
            AssignSubject::create([
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id[$i]
            ]);
        }

        return Response::json('Assign updated added successfully!', 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AssignSubject::where('class_id', $id)->delete();
        return Response::json('Assign subject deleted successfully!', 200);
    }

    public function allDelete(Request $request){


        for($i = 0; $i < count($request->checkBox); $i++){
            AssignSubject::where('class_id', $request->checkBox[$i])->delete();
        }

        return Response::json('Assign subject deleted successfully!', 200);

    }

}
