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

   
    // public function login(Request $request)
    // {
    //     //
    //     $this->validate($request, [
    //         'username' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $user = User::where('username',$request->input('username'))->first();

    //     if(!isset($user)){
    //         return response()->json(
    //             [
    //                 'status' => false,
    //                 'message' => 'User does not exist'
    //             ]
    //         );
    //     }

    //     if (Hash::check($request->input('password'), $user->password)){
    //         return response()->json(['status' => 'success'],200);
    //     }else{
    //         return response()->json(['status' => 'fail',401]);
    //     }

        
    // }

   
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
 
        $user = new User($request->all());
        $user->save($request->all());
        return response()->json($user,200);
    }






    public function updateUser(Request $request, $user_id)
    {
        $payload = $request->all();

        $this->validate($request, [
            'raw_password'=> ['required',Password::min(8)],
            'raw_password_equal' =>
            [
                'required',
                function ($attribute, $value, $fail) use ($payload) {

                    if($payload['raw_password'] != $value){
                        $fail('Passwords dont match');
                    }
                },Password::min(8)
            ],

            'first_name'=> 'required',
            'last_name' => 'required',

        ]);

        $user = User::where(['id' =>$user_id])->first();

        echo '<pre>'.print_r($user,true).'</pre>';die();

        $user->update(array('password'=>'raw_password'));





        
    }


}