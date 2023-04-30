<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth:admin')->except(['Register', 'Login']);
        $this->middleware('jwtAuth')->except(['Register', 'Login']);
    }


    public function Register(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);



        $token = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($token){
            return $this->respondWithToken($token);
        }



    }

    public function Login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($token = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){

            return $this->respondWithToken($token);

        }else{
            return Response::json('Invalid Email or Password!');
        }


    }

    public function Logout(){

        Auth::guard('admin')->logout();
        return Response::json('Logout successfully!');

    }

    public function getAuthUser(){
        return Response::json(Auth::guard('admin')->user());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('admin')->factory()->getTTL() * 43200,
            'user_id' => Auth::guard('admin')->user()->id,
            'name' => Auth::guard('admin')->user()->name,
            'email' => Auth::guard('admin')->user()->email,
        ]);
    }


}
