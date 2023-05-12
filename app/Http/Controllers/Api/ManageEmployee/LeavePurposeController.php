<?php

namespace App\Http\Controllers\Api\ManageEmployee;

use App\Http\Controllers\Controller;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LeavePurposeController extends Controller
{

    public function index()
    {
        $data = LeavePurpose::all();
        return Response::json($data);
    }

}
