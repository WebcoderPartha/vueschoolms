<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GroupController extends Controller
{

    public function index()
    {
        $data = Group::orderBy('id', 'DESC')->get();

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
                Group::create([
                    'name' => $value
                ]);
            }

        }else{
            Group::create([
                'name' => $request->add_group
            ]);
        }

        return Response::json('Group added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Group::find($id);
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Group::find($id);

        $this->validate($request, [
            'name' => 'unique:groups,name,'.$data->id
        ]);

        Group::find($id)->update([
            'name' => $request->name
        ]);

        return Response::json('Group updated successfully!', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Group::find($id)->delete();
        return Response::json('Group deleted successfully!', 200);

    }

    public function allDelete(Request $request){

//        for ($i = 0; $i < count($request->checkBox); $i++){
//
//            $std =StudentClass::find($request->checkBox[$i]);
//            $std->delete();
//        }
        foreach ($request->selected as $value){

            Group::find($value)->delete();
        }

        return Response::json('Group deleted successfully!', 200);
    }


}
