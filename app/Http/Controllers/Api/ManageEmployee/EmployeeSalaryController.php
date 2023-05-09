<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class EmployeeSalaryController extends Controller
{

    public function index(){
        $data = EmployeeSalary::with('employee')->orderBy('id', 'DESC')->get();

        return Response::json($data);
    }

}
