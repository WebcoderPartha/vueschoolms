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
