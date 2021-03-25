<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Models\PhonebookModel;
class PhonebookController extends Controller
{
    public function insert(Request $request)
    {
        $jwt=$request->input('api_token');
        $decoded = JWT::decode($jwt, env('API_KEY'), array('HS256'));
        $decoded_array = (array)$decoded;

        $username=$decoded_array['user'];
        $phone=$request->input('phone');
        $email=$request->input('email');
        $name=$request->input('name');

        PhonebookModel::insert([
            'username'=>$username,
            'phone'=>$phone,
            'email'=>$email,
            'name'=>$name
        ]);
        return response()->json(['success'=>'Phone Book Added']);
    }
    public function select(Request $request)
    {
        $jwt=$request->input('api_token');
        $decoded = JWT::decode($jwt, env('API_KEY'), array('HS256'));
        $decoded_array = (array)$decoded;
        $username = $decoded_array['user'];

        $result = PhonebookModel::where('username',$username)->get();
        return response()->json($result);
    }
    public function delete(Request $request)
    {
        $jwt=$request->input('api_token');
        $decoded = JWT::decode($jwt, env('API_KEY'), array('HS256'));
        $decoded_array = (array)$decoded;
        $username = $decoded_array['user'];

        $email = $request->input('email');
        $result = PhonebookModel::where('username',$username)->where('email',$email)->first();
        $result->delete();
        return response()->json(['success'=>'Data deleted']);
    }
    public function edit(Request $request)
    {
        $jwt=$request->input('api_token');
        $decoded = JWT::decode($jwt, env('API_KEY'), array('HS256'));
        $decoded_array = (array)$decoded;
        $username = $decoded_array['user'];

        $email = $request->input('email');
        $phone=$request->input('phone');
        $name=$request->input('name');

        PhonebookModel::where('username',$username)->where('email',$email)->update([
            'phone'=>$phone,
            'name'=>$name
        ]);
        return response()->json(['success'=>'Data updated']);

    }
}
