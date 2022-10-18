<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentsController extends Controller
{
 
    public function getComments()
    {
        $comments = Comment::all();
        return response()->json($comments);

    }

    public function addComments(Request $request)
    {
        //addnewcomments
        $this->validate($request, [
            'content' => 'required',
            'id_user' => 'required|exists:users,id',
            'id_post' => 'required|exists:posts,id'
        ]);
        $comments = new Comment($request->all());
        $comments->save($request->all());

        return response()->json($comments);
    }

}
