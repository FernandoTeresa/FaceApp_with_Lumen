<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rules\Password;


class usersController extends Controller
{


   
    public function getUser($id)
    {
        //give 1 user
        $user = User::find($id);
        return response()->json($user,200);
    }

   
    public function newUser(Request $request)
    {
        //1º validation
        $this->validate($request, [
            'username'=> 'required|unique:users,username',
            'password'=> ['required', Password::min(8)],
            'first_name'=> 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email'
        ]);
        $user = new User($request->all());
        $user->save($request->all());
        return response()->json($user,200);
    }



    public function updateUser(Request $request, $user_id)
    {
        $log = auth()->user();

        $payload = $request->all();

        $this->validate($request, [
            'password'=> ['required',Password::min(8)],
            'raw_password' =>
            [
                'required',
                function ($attribute, $value, $fail) use ($payload) {

                    if($payload['password'] != $value){
                        $fail('Passwords dont match');
                    }
                },Password::min(8)
            ],

            'first_name'=> 'required|string',
            'last_name' => 'required|string',

        ]);

        if ($log->id == $user_id){

            $user = User::where(['id' =>$user_id])->first();
            $user->password = Hash::make($request->password); // ??? pk nao vai para a funçao creating ou sera saving???
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->save();

            return response()->json('Profile Updated successfully!');
        }else{
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized Request'
            ]);
        };

        echo '<pre>'.print_r($request,true).'</pre>';die();
    }


}