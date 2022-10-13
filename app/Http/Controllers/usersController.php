<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class usersController extends Controller
{

   
    public function create(Request $request)
    {
        //POST data to database from user
    }

    public function show($id)
    {
        //give 1 user
        $user = User::find($id);
        return response()->json($user);
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function delete($id)
    {
        //Delete method
    }
}
