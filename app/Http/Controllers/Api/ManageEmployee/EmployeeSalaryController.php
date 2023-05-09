<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EmployeeSalaryController extends Controller
{

    public function increment(Request $request, string $id){

        $employee = Employee::find($id);

        $previous_salary = $employee->salary;
        $present_salary = $previous_salary + $request->increment_salary;

        $employee->salary = $present_salary;
        $employee->save();

        EmployeeSalary::create([
            'employee_id' => $id,
            'previous_salary' => $previous_salary,
            'present_salary' => $present_salary,
            'increment_salary' => $request->increment_salary,
            'increment_salary_date' => date('Y-m-d', strtotime($request->increment_salary_date)),
        ]);


        return Response::json('Salary increment!');
    }

}
