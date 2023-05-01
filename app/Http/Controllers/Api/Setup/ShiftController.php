<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ShiftController extends Controller
{


    public function index()
    {
        $data = Shift::orderBy('id', 'DESC')->get();

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
                Shift::create([
                    'name' => $value
                ]);
            }

        }else{
            Shift::create([
                'name' => $request->add_shift
            ]);
        }

        return Response::json('Shift added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Shift::find($id);
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Shift::find($id);

        $this->validate($request, [
            'name' => 'unique:shifts,name,'.$data->id
        ]);

        Shift::find($id)->update([
            'name' => $request->name
        ]);

        return Response::json('Shift updated successfully!', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Shift::find($id)->delete();
        return Response::json('Shift deleted successfully!', 200);

    }

    public function allDelete(Request $request){

//        for ($i = 0; $i < count($request->checkBox); $i++){
//
//            $std =StudentClass::find($request->checkBox[$i]);
//            $std->delete();
//        }
        foreach ($request->selected as $value){

            Shift::find($value)->delete();
        }

        return Response::json('Shift deleted successfully!', 200);
    }

}
