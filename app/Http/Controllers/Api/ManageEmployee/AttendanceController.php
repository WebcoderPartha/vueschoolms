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
        $data = Attendance::select('attendance_date')->groupBy('attendance_date')->get();
        return Response::json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->form); $i++){
            Attendance::create([
                'employee_id' => $request->form[$i]['employee_id'],
                'attendance_status' => $request->form[$i]['attendance_status'],
                'attendance_date' => date('Y-m-d', strtotime($request->form[$i]['attendance_date'])),
            ]);
        }

        return Response::json('Attendance store successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
