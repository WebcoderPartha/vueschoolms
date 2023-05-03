<?php

namespace App\Http\Controllers\Api\ManageStudent;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\Student;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class RegisterStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AssignStudent::with('year', 'student_class', 'group', 'student', 'shift')->orderBy('id', 'desc')->get();
        return Response::json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $id_number = IdGenerator::generate([
            'table' => 'students',
            'field' => 'id_number',
            'length' => 8,
            'prefix' => date('Y')
        ]);


        if ($request->image){

            $position  = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-student'.'.'.$extension;
            $directory = 'uploads/student/';

            Image::make($request->image)->resize(300, 300)->save(public_path($directory.$photo));

            $student = Student::create([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'date_of_birth' => date('d-F-Y', strtotime($request->date_of_birth)),
                'id_number' => $id_number,
                'gender' => $request->gender,
                'religion' => $request->religion,
                'image' => $directory.$photo,
            ]);

            AssignStudent::create([
                'student_id' => $student->id,
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id,
                'discount_percentage' => $request->discount_percentage,
            ]);




        }else{

            $student = Student::create([
                'name' => $request->name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'date_of_birth' => date('d-F-Y', strtotime($request->date_of_birth)),
                'id_number' => $id_number,
                'gender' => $request->gender,
                'religion' => $request->religion,
            ]);

            AssignStudent::create([
                'student_id' => $student->id,
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id,
                'discount_percentage' => $request->discount_percentage,
            ]);

        }

        return Response::json('Student added successfully');

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
