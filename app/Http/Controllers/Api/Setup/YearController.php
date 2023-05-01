<?php

namespace App\Http\Controllers\Api\Setup;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class YearController extends Controller
{
    public function index()
    {
        $data = Year::orderBy('id', 'DESC')->get();

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
                Year::create([
                    'name' => $value
                ]);
            }

        }else{
            Year::create([
                'name' => $request->add_year
            ]);
        }

        return Response::json('Year added successfully!', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Year::find($id);
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Year::find($id);

        $this->validate($request, [
            'name' => 'unique:years,name,'.$data->id
        ]);

        Year::find($id)->update([
            'name' => $request->name
        ]);

        return Response::json('Year updated successfully!', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Year::find($id)->delete();
        return Response::json('Year deleted successfully!', 200);

    }

    public function allDelete(Request $request){

//        for ($i = 0; $i < count($request->checkBox); $i++){
//
//            $std =StudentClass::find($request->checkBox[$i]);
//            $std->delete();
//        }
        foreach ($request->selected as $value){

            Year::find($value)->delete();
        }

        return Response::json('Year deleted successfully!', 200);
    }
}
