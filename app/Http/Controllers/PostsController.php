<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class postsController extends Controller
{

/*
Run -> php -S localhost:8000 -t public

*/
    public function getPosts()
    {
        $posts = Post::where([])->with('comments')->with('user')->get();     //var posts vai guardar todos os dados do modelo (posts) devido ao all()
        return response()->json($posts); // retorna uma resposta dos dados no formato json
    }

   
    public function addNewPosts(Request $request)
    {
        //1º validation
        $this->validate($request, [
            'title'=> 'required',
            'content'=> 'required',
            'id_user'=> 'required|exists:users,id' 
        ]);
        $post = new Post($request->all());
        $post->save($request->all());

        return response()->json($post);
    }

 
    public function get_by_user($user_id)
    {
        //show item by id

        $posts = Post::where(['id_user'=>$user_id])->with('comments')->with('user')->get(); //return if not found empty, if found return a objet
        return response()->json($posts);

    }


    public function remove_by_user($post_id)
    {
        //erase by id
        $user = auth()->user();
        $post = Post::where(['id'=>$post_id, 'id_user' =>$user->id])->first();
        if ($post != null){
            $post->delete();
        }else{
            return response()->json([
                'status' => '404',
                'message' => 'Not Found'
            ]);
        }
        return response()->json('Post deleted successfully!'); 
    }
}
