<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\RegistrationModel;
use \Firebase\JWT\JWT;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        $first_name=$request->input('first_name');
        $last_name=$request->input('last_name');
        $city=$request->input('city');
        $username=$request->input('username');
        $password= Hash::make($request->input('password'));
        $gender=$request->input('gender');

        $checkusername = RegistrationModel::where('username',$request->username)->count();
        if($checkusername ==1)
        {
            return response()->json(['error'=>'username already exist']);
        }else
        {
            RegistrationModel::insert(['first_name'=>$first_name,'last_name'=>$last_name,'city'=>$city,'username'=>$username,'password'=>$password,'gender'=>$gender]);
            return response()->json(['success'=>'Registration success']);
        }

    }
    public function login(Request $request)
    {
        $username=$request->input('username');
        $password= $request->input('password');
        $checkusername = RegistrationModel::where('username',$request->username)->first();
        if($checkusername)
        {
            if (Hash::check($request->input('password'), $checkusername->password)) {
                $key = env('API_KEY');
                $payload = array(
                    "iss" => "http://localhost:8000",
                    "user" => $username,
                    "iat" => time(),
                    "exp" => time()+300
                );
                $jwt = JWT::encode($payload, $key);
                return response()->json(['status'=>'Login Success','user'=>$checkusername,'token'=>$jwt]);
            }
            return response()->json(['error'=>'Password does not match']);
        }else
        {
            return response()->json(['error'=>'username incorrect']);
        }
    }

    
}
