<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\File;


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
            'password'=> [Password::min(8)],
            'raw_password' =>
            [
            
                function ($attribute, $value, $fail) use ($payload) {

                    if($payload['password'] != $value){
                        $fail('Passwords dont match');
                    }
                },Password::min(8)
            ],

            'first_name'=> 'string',
            'last_name' => 'string',

        ]);

        if ($log->id == $user_id){

            $user = User::where(['id' =>$user_id])->first();
        
            if ($request->password != $user->password){
                $user->password = Hash::make($request->password);
            }

            if ($request->first_name != $user->first_name){
                $user->first_name = $request->first_name;
            }

            if ($request->last_name != $user->last_name){
                $user->last_name = $request->last_name;
            }

            $user->save();

            return response()->json('Profile Updated successfully!');
        }else{
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized Request'
            ]);
        };
    }


    public function uploadImg(Request $request, $user_id){
        $log = auth()->user();

        if ($log->id == $user_id){

            $user = User::where(['id' =>$user_id])->first();
        
            if($request->hasfile('photo')){
                $original_name = $request->file('photo')->getClientOriginalName();
                $original_name_arr = explode('.', $original_name);
                $file_ext = end($original_name_arr);
                //$allowedExtensions=['jpg','jpeg','png','gif'];

                $path = public_path('pics/');
                if(!File::isDirectory($path)){
                    File::makeDirectory($path, 0777, true, true);
                }

                //$path = '/pics/'.$user_id.'/';
                $name = 'avatar.' . $file_ext;
                $endpath = $path.$user_id;
                
                if(!File::isDirectory($endpath)){
                    File::makeDirectory($endpath, 0777, true, true);
                }
                if($request->file('photo')->move($endpath,$name)){
                    
              

                    $user->photo = $endpath.'/'.$name;

                    $user->save();


                    return response()->json('Photo Uploaded successfully!');
                }else{

                    return response()->json('Cannot upload file');
                }
            }else{
                return response()->json('File not found');
            }

            
        }else{
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized Request'
            ]);
        }

    }

}