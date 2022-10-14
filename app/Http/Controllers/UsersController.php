<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class usersController extends Controller
{

   
    public function getUser($id)
    {
        //give 1 user
        $user = User::find($id);
        return response()->json($user,200);
    }

   
    public function login(Request $request)
    {
        //
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username',$request->input('username'))->first();

        if (Hash::check($request->input('password'), $user->password)){
            return response()->json(['status' => 'success'],200);
        }else{
            return response()->json(['status' => 'fail',401]);
        }
    }

   
    public function newUser(Request $request)
    {
        //1º validation
        $this->validate($request, [
            'username'=> 'required',
            'raw_password'=> 'required',
            'first_name'=> 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);
        // $username = $request->input('username');
        // $password = Hash::make($request->input('password'));
        // $fname = $request->input('first_name');
        // $lname = $request->input('last_name');
        // $email = $request->input('email');

        // $regUser = User::create([
        //     'username' => $username,
        //     'password' => $password,
        //     'first_name' => $fname,
        //     'last_name' => $lname,
        //     'email' => $email
        // ]);

        // if($regUser){
        //     return response()->json($regUser,200);
        // }else{
        //     return response()->json(['status'=>'fail'],401);
        // }


        $user = new User($request->all());
        $user->save($request->all());
        return response()->json($user,200);
    }

}
