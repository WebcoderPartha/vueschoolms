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
    public function __construct(){
        $this->middleware('admin')->except([
            'Register',
            'Login'
        ]);
    }

    public function Register(Request $request){

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($token){
            return $this->respondWithToken($token);
        }

    }

    public function Login(Request $request){

        $token = Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($token){
            return $this->respondWithToken($token);
        }else{
            return Response::json('Invalid Email or Password!');
        }

    }

    public function Logout(){
        Auth::guard('admin')->logout();
        return Response::json('Logout successfully!');
    }



    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('admin')->factory()->getTTL() * 60
        ]);
    }
}
