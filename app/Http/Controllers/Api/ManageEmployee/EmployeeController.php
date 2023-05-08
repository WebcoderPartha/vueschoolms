<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::with('designation')->orderBy('id', 'DESC')->get();

        return Response::json($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_number = IdGenerator::generate([
            'table' => 'employees',
            'field' => 'id_number',
            'length' => 6,
            'prefix' => date('y')
        ]);


        if ($request->image){

            $position  = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-student'.'.'.$extension;
            $directory = 'uploads/employee/';

            Image::make($request->image)->resize(300, 300)->save(public_path($directory.$photo));

            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'id_number' => $id_number,
                'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
                'designation_id' => $request->designation_id,
                'image' => $directory.$photo,
            ]);


        }else{
            Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'id_number' => $id_number,
                'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
                'designation_id' => $request->designation_id,
            ]);


        }

        return Response::json('Employee added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Employee::find($id);

        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $employee = Employee::find($id);

        if ($file = $request->new_image){

            $position = strpos($request->new_image, ';');
            $sub = substr($request->new_image, 0, $position);
            $extension = explode('/', $sub)[1];

            $photo = time().'-employee'.'.'.$extension;
            $directory = 'uploads/employee/';

            Image::make($request->new_image)->resize(300, 300)->save(public_path($directory.$photo));




            // IF Image Exist in the folder
            if ($employee->image !== null){
                if (file_exists(public_path($employee->image))){
                    unlink(public_path($employee->image));
                }

            } // end if


            Employee::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
                'designation_id' => $request->designation_id,
                'image' => $directory.$photo,
            ]);

            return Response::json('Employee updated successfully');

        }else{


            Employee::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'salary' => $request->salary,
                'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
                'designation_id' => $request->designation_id,
            ]);

            return Response::json('Student updated successfully');

        } // end else



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);

        if ($employee->image !== null){
            if (file_exists(public_path($employee->image))){
                unlink(public_path($employee->image));
                $employee->delete();

            }else{
                $employee->delete();
            }
        }

        $employee->delete();
        return Response::json('Employee deleted successfully');
    }
}
