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

        $log = auth()->user();
        //addnewcomments
        $this->validate($request, [
            'content' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'id_post' => 'required|exists:posts,id'
        ]);

        if ($log){
            $comments = new Comment($request->all());
            $comments->save($request->all());

            return response()->json($comments);
        }else{
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized Request'
            ]);
        }
        
    }


    public function updateComment(Request $request, $comment_id){

        $log= auth()->user();

        $this->validate($request, [
            'content' => 'required|string',
            'id_user' => 'required|exists:users,id',
            'id_post' => 'required|exists:posts,id'
        ]);

        $comment = Comment::where(['id' => $comment_id])->first();

        if ($log->id == $comment->id_user){

            $comment->content = $request->content;
            $comment->save();

            return response()->json('Comment updated successfully!');

        }else{
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized Request'
            ]);
        }

    }


    public function deleteComment($comment_id){

        $log = auth()->user();

        $comment = Comment::where(['id' => $comment_id])->first();


        if ($comment != null){


            if ($log->id == $comment->id_user){

                $comment->delete();
                return response()->json('Comment deleted successfully!'); 
            }else{

                return response()->json([
                    'status' => '401',
                    'message' => 'Unauthorized Request'
                ]);
                
            }


        }else{
            return response()->json([
                'status' => '404',
                'message' => 'Not Found'
            ]);
        }
        

    }

}
