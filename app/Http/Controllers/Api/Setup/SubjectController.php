<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SubjectController extends Controller
{

    public function index()
    {
        $data = Subject::orderBy('id', 'DESC')->get();

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
                Subject::create([
                    'name' => $value
                ]);
            }

        }

        return Response::json('Subject added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Subject::find($id);
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Subject::find($id);

        $this->validate($request, [
            'name' => 'unique:subjects,name,'.$data->id
        ]);

        Subject::find($id)->update([
            'name' => $request->name
        ]);

        return Response::json('Subject updated successfully!', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::find($id)->delete();
        return Response::json('Subject deleted successfully!', 200);

    }

    public function allDelete(Request $request){

//        for ($i = 0; $i < count($request->checkBox); $i++){
//
//            $std =StudentClass::find($request->checkBox[$i]);
//            $std->delete();
//        }
        foreach ($request->selected as $value){

            Subject::find($value)->delete();
        }

        return Response::json('Subject deleted successfully!', 200);
    }

}
