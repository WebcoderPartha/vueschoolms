<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Designation::orderBy('id', 'DESC')->get();
        return Response::json($data, 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        for ($i=0; $i < count($request->names); $i++){
            Designation::create([
                'name' => $request->names[$i]['name']
            ]);
        }

        return Response::json('Data store successfully!', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Designation::find($id);
        return Response::json($data, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = Designation::where('id', $id)->update([
            'name' => $request->name
        ]);

        return Response::json('Updated successfully!', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $data = Designation::where('id', $id)->delete();
        return Response::json('Deleted successfully!', 200);

    }

    public function allDelete(Request $request){
        for ($i = 0; $i < count($request->checkBox); $i++){
            Designation::where('id', $request->checkBox[$i])->delete();
        }

        return Response::json('Deleted successfully!', 200);
    }
}
