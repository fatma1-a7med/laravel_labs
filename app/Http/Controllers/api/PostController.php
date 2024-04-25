<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use  App\Http\Requests\StorePostRequest;
use  App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function index(){

        $posts = Post::with('user')->paginate(5); 
        return PostResource::collection($posts);
    }

   

    function store(StorePostRequest $request)
{
    $post = new Post;
    $post->name = $request->name;
    $post->body = $request->body;
    $post->user_id= $request->user_id;
    $post->save();

    return "Added successfully";
}
    function show($id){
      
        $post= Post::find($id);
        return $post;
    }
    function update($id, StorePostRequest $request)
    {
        $post = Post::find($id);
    
        $post->name = $request->name;
        $post->body = $request->body;
        $post->user_id = $request->user_id; 

        $post->save();
    
        return 'updated successfully';;
    }
    
    function destroy($id)
{
    $post = Post::find($id);

    $post->delete();

    return "deleted successfully";
}

    
}
