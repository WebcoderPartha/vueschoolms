<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ExamTypeController extends Controller
{

    public function index()
    {
        $data = ExamType::orderBy('id', 'DESC')->get();

        return Response::json($data);
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
                ExamType::create([
                    'name' => $value
                ]);
            }

        }

        return Response::json('Examtype added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ExamType::find($id);
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ExamType::find($id);

        $this->validate($request, [
            'name' => 'unique:exam_types,name,'.$data->id
        ]);

        ExamType::find($id)->update([
            'name' => $request->name
        ]);

        return Response::json('Examtype updated successfully!', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExamType::find($id)->delete();
        return Response::json('Examtype deleted successfully!', 200);

    }

    public function allDelete(Request $request){

//        for ($i = 0; $i < count($request->checkBox); $i++){
//
//            $std =StudentClass::find($request->checkBox[$i]);
//            $std->delete();
//        }
        foreach ($request->selected as $value){

            ExamType::find($value)->delete();
        }

        return Response::json('Examtype deleted successfully!', 200);
    }

}
