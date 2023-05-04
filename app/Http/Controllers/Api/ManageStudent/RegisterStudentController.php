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
        $data = AssignStudent::with('student', 'year', 'student_class')->orderBy('id', 'desc')->get();
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
                'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
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
                'date_of_birth' => date('Y-m-d', strtotime($request->date_of_birth)),
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
        $data = Student::find($id);
//        $data['assign_student'] = AssignStudent::with('year', 'student_class')->find($id);
        return Response::json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


//        return $request->new_image;
        $student = Student::find($id);

        if ($file = $request->new_image){

            $position = strpos($request->new_image, ';');
            $sub = substr($request->new_image, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-customer'.'.'.$extension;
            $directory = 'uploads/student/';

            Image::make($request->new_image)->resize(300, 300)->save(public_path($directory.$photo));




            // IF Image Exist in the folder
            if ($student->image !== null){
                if (file_exists(public_path($student->image))){
                    unlink(public_path($student->image));
                }

            } // end if


            $student->name = $request->form['name'];
            $student->father_name = $request->form['father_name'];
            $student->mother_name = $request->form['mother_name'];
            $student->email = $request->form['email'];
            $student->phone = $request->form['phone'];
            $student->address = $request->form['address'];
            $student->date_of_birth = date('Y-m-d', strtotime($request->form['date_of_birth']));
            $student->gender = $request->form['gender'];
            $student->religion = $request->form['religion'];
            $student->image = $directory.$photo;
            $student->save();

            return Response::json('Customer updated successfully');

        }else{

            $student->name = $request->form['name'];
            $student->father_name = $request->form['father_name'];
            $student->mother_name = $request->form['mother_name'];
            $student->email = $request->form['email'];
            $student->phone = $request->form['phone'];
            $student->address = $request->form['address'];
            $student->date_of_birth = date('Y-m-d', strtotime($request->form['date_of_birth']));
            $student->gender = $request->form['gender'];
            $student->religion = $request->form['religion'];

            $student->save();

            return Response::json('Customer updated successfully');

        } // end else


//        if ($request->file('new_image')){
//
//            $position  = strpos($request->new_image, ';');
//            $sub = substr($request->new_image, 0, $position);
//            $extension = explode('/', $sub)[1];
//
//            $photo = time().'-student'.'.'.$extension;
//            $directory = 'uploads/student/';
//
//            Image::make($request->new_image)->resize(300, 300)->save(public_path($directory.$photo));
//
//            if ($student->image !== NULL){
//                if (file_exists(public_path($student->image))){
//                    unlink(public_path($student->image));
//                }
//            }
//
//
//            $student->name = $request->form['name'];
//            $student->father_name = $request->form['father_name'];
//            $student->mother_name = $request->form['mother_name'];
//            $student->email = $request->form['email'];
//            $student->phone = $request->form['phone'];
//            $student->address = $request->form['address'];
//            $student->date_of_birth = date('Y-m-d', strtotime($request->form['date_of_birth']));
//            $student->gender = $request->form['gender'];
//            $student->religion = $request->form['religion'];
//            $student->image = $directory.$photo;
//            $student->save();
//
//
//
//
//        }else{
//
//
//
//            $student->name = $request->form['name'];
//            $student->father_name = $request->form['father_name'];
//            $student->mother_name = $request->form['mother_name'];
//            $student->email = $request->form['email'];
//            $student->phone = $request->form['phone'];
//            $student->address = $request->form['address'];
//            $student->date_of_birth = date('Y-m-d', strtotime($request->form['date_of_birth']));
//            $student->gender = $request->form['gender'];
//            $student->religion = $request->form['religion'];
//            $student->save();
//
//
//
//        }

//        return Response::json('Student updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }


    public function allDelete(Request $request){

    }


}
