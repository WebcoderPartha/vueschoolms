<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = StudentClass::orderBy('id', 'DESC')->get();

        return Response::json($class);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required|unique:student_classes,name'
//        ]);

        if (count($request->name) > 0){

            foreach ($request->name as $value){
                StudentClass::create([
                    'name' => $value
                ]);
            }

        }else{
            StudentClass::create([
                'name' => $request->class_name
            ]);
        }

        return Response::json('Class added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = StudentClass::find($id);
        return Response::json($class);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = StudentClass::find($id);

        $this->validate($request, [
            'name' => 'required|unique:student_classes,name,'.$class->id
        ]);

        StudentClass::find($id)->update([
            'name' => $request->name
        ]);

        return Response::json('Class updated successfully!', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StudentClass::find($id)->delete();
        return Response::json('Class deleted successfully!', 200);

    }

    public function allDelete(Request $request){

//        for ($i = 0; $i < count($request->checkBox); $i++){
//
//            $std =StudentClass::find($request->checkBox[$i]);
//            $std->delete();
//        }
        foreach ($request->checkBox as $value){

            StudentClass::find($value)->delete();
        }

        return Response::json('Class deleted successfully!', 200);
    }
}
