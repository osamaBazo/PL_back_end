<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class UserController extends Controller
{
    //
    public  function store(Request $request){
        $request->validate([
            'full_name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required',
            'phone_number'=> 'required',
            'img_url'=> 'required',
        ]);
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->phone_number = $request->input('phone_number');
        $user->img_url = $request->input('img_url');
        $user->save();
        // return a token
    }
    public function index(){
        //$product = Product::all();
        $user = User::orderBy('created_at','desc')->get();
        $jsonContent =json_decode($user, true);
        return response()->json(['Users'=> $jsonContent], 200);
    }
    public function show($id){
        if(User::where('id', $id)->exists()){
            $user = User::where('id', $id)->first();
            return response()-> json([
                'status'=> 1,
                'User details'=> $user
            ]);
        }else{
            return response([
                'status'=> 0,
                'message'=> 'User not found'
            ],404);
        }
    }
    public function update(Request $request,$id){
        if(User::where('id', $id)->exists()){
            $user = User::find($id);

            $user->full_name = !empty($request->input('full_name')) ? $request->input('full_name') : $user->full_name;
            $user->email = !empty($request->input('email')) ? $request->input('email') : $user->email;
            $user->password = !empty($request->input('password')) ? $request->input('password') : $user->password;
            $user->phone_number = !empty($request->input('phone_number')) ? $request->input('phone_number') : $user->phone_number;
            $user->img_url = !empty($request->input('img_url')) ? $request->input('img_url') : $user->img_url;
            $user->save();
            return response()-> json([
                'message'=>'Updated Successfully'
            ], 200);
        }else{
            return response([
                'status'=> 0,
                'message'=> 'User not found'
            ],404);
        }
    }
    public function destroy(Request $request, $id){
        if(User::where('id', $id)->exists()){
            $user = User::findOrfail($id);
            $user->delete();
            return response()-> json([
                'status'=> 1,
                'message'=> 'User deleted successfully'
            ]);
        }else{
            return response([
                'status'=> 0,
                'message'=> 'User not found'
            ],404);
        }
    }
}
