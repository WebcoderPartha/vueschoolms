<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Leave::with('employee', 'purpose')->orderBy('id', 'DESC')->get();
        return Response::json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->leave_purpose_id === 'new_purpose'){

            $leavePurpose = LeavePurpose::create([
                'leave_purpose' => $request->add_new_purpose
            ]);

            $leave = Leave::create([
                'employee_id' => $request->employee_id,
                'leave_purpose_id' => $leavePurpose->id,
                'leave_start_date' => date('Y-m-d', strtotime($request->leave_start_date)),
                'leave_end_date' => date('Y-m-d', strtotime($request->leave_end_date))
            ]);


        }else{

            $leave = Leave::create([
                'employee_id' => $request->employee_id,
                'leave_purpose_id' => $request->leave_purpose_id,
                'leave_start_date' => date('Y-m-d', strtotime($request->leave_start_date)),
                'leave_end_date' => date('Y-m-d', strtotime($request->leave_end_date))
            ]);

        }


        return Response::json('Employee leave added!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Leave::find($id);
        return Response::json($data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        if ($request->leave_purpose_id === 'new_purpose'){

            $leavePurpose = LeavePurpose::create([
                'leave_purpose' => $request->add_new_purpose
            ]);

            $leave = Leave::where('id', $id)->update([
                'employee_id' => $request->employee_id,
                'leave_purpose_id' => $leavePurpose->id,
                'leave_start_date' => date('Y-m-d', strtotime($request->leave_start_date)),
                'leave_end_date' => date('Y-m-d', strtotime($request->leave_end_date))
            ]);


        }else{

            $leave = Leave::where('id', $id)->update([
                'employee_id' => $request->employee_id,
                'leave_purpose_id' => $request->leave_purpose_id,
                'leave_start_date' => date('Y-m-d', strtotime($request->leave_start_date)),
                'leave_end_date' => date('Y-m-d', strtotime($request->leave_end_date))
            ]);

        }

        return Response::json('Employee leave updated!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Leave::find($id)->delete();
        return Response::json('Employee leave deleted');
    }

    public function deleteAll(Request $request){

        foreach ($request->checkBox as $value){

            Leave::where('id', $value)->delete();

        }


        return Response::json('Employee leave deleted');


    }

}
