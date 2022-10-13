<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Date;

class postsController extends Controller
{
   
    public function index()
    {
        $posts = Post::all();     //var posts vai guardar todos os dados do modelo (posts) devido ao all()
        return response()->json($posts); // retorna uma resposta dos dados no formato json
    }

   
    public function create(Request $request)
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

 
    public function show($id)
    {
        //show item by id

        $post = Post::find($id); 

        return response()->json($post);

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
        //erase by id
        $post = Post::find($id);
        $post->delete();
        return response()->json('Post deleted successfully!'); 
    }
}
