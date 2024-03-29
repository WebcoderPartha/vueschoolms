<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class AttendanceController extends Controller
{


    public function index()
    {
        $data = Attendance::select('attendance_date')->groupBy('attendance_date')->orderBy('attendance_date', 'DESC')->get();
        return Response::json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $check = Attendance::where('attendance_date', date('Y-m-d', strtotime($request->form[0]['attendance_date'])))->first();


        if (!$check){
            for ($i = 0; $i < count($request->form); $i++){
                Attendance::create([
                    'employee_id' => $request->form[$i]['employee_id'],
                    'attendance_status' => $request->form[$i]['attendance_status'],
                    'attendance_date' => date('Y-m-d', strtotime($request->form[$i]['attendance_date'])),
                ]);
            }

            return Response::json('Attendance store successfully!');
        }else{
            return Response::json('Already Attendance stored!');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Attendance::with('employee')->where('attendance_date', $id)->get();
        return Response::json($data);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        Attendance::where('attendance_date', $id)->delete();

            for ($i = 0; $i < count($request->form); $i++){
                Attendance::create([
                    'employee_id' => $request->form[$i]['employee_id'],
                    'attendance_status' => $request->form[$i]['attendance_status'],
                    'attendance_date' => date('Y-m-d', strtotime($request->form[$i]['attendance_date'])),
                ]);
            }



        return Response::json('Attendance updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Attendance::where('attendance_date', $id)->delete();
    }

    public function deleteAll(Request $request){

        for ($i = 0; $i < count($request->selected); $i++){
            Attendance::where('attendance_date', $request->selected[$i])->delete();

        }

        return Response::json('Attendance deleted successfully!');
    }
}
