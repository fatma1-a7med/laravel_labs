<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use  App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function index(){
       /*  $posts=[
            ["id"=> 1,
            "name"=>"Post one",
            "body"=>"the post one body",
            "comment"=>"comment one"
       ],
       [
           "id"=> 2,
            "name"=>"Post two",
            "body"=>"the post two body",
            "comment"=>"comment two"
       ],
       [
           "id"=> 3,
            "name"=>"Post three",
            "body"=>"the post three body",
            "comment"=>"comment three"
       ]
       ]; */
       //$posts= Post::all();
       $posts= Post::paginate(5);
       return view('posts.index', ['posts' => $posts]);
    }

    function create(){
        return view("posts.create");
    }
/*     function store(StorePostRequest $request){

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('images', 'public');
        }

        Post::create(
            [
                "name"=>$request->name,
                "body"=> $request->body,
                "user_id"=> $request->user_id,
                "image" => $imageName, 
            ]
            );
        return redirect("/posts");
    } */

    function store(StorePostRequest $request)
{
    $post = new Post;
    $post->name = $request->name;
    $post->body = $request->body;
    $post->user_id= $request->user_id;

    $timestamp = now()->timestamp;

     $originalFilename = $request->image->getClientOriginalName();
 
     $filename = $timestamp . '_' . $originalFilename;
 
     $request->image->move(public_path('images'), $filename);
 
     $post->image = $filename;

    $post->save();

    return redirect("/posts");
}
    function show($id){
        /* $post=[
            "id"=> $id,
            "name"=>"Post one",
            "body"=>"the post one body",
            "comment"=>"comment one"
        ]; */
        $post= Post::find($id);

        return view('posts.show', ['post' => $post]);
    }
    function edit($id){
       /*  $post = [
            "id"=> $id,
            "name"=>"Post one",
            "body"=>"the post one body",
            "comment"=>"comment one"
        ]; */
        $post= Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }
    function update($id, StorePostRequest $request)
    {
        $post = Post::find($id);
    
        // Check if the image exists and is not null
        if ($post->image != null) {
            $imagePath = public_path('images/' . $post->image);
    
            if (file_exists($imagePath)) {
                if (!unlink($imagePath)) {
                    return back()->with('error', 'Failed to delete old image file.');
                }
            } else {
                return back()->with('error', 'Old image file does not exist.');
            }
        }
    
        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $timestamp = now()->timestamp;
            $originalFilename = $request->file('image')->getClientOriginalName();
            $filename = $timestamp . '_' . $originalFilename;
    
            $request->file('image')->move(public_path('images'), $filename);
    
            $post->image = $filename;
        }
    
        $post->name = $request->name;
        $post->body = $request->body;
    
        $post->save();
    
        return redirect("/posts");
    }
    
    function destroy($id)
{
    $post = Post::find($id);

    if (!$post) {
        return back()->with('error', 'Post not found.');
    }

    $imagePath = public_path('images/' . $post->image);

    // Check if the post has an image and if it exists
    if ($post->image && file_exists($imagePath)) {
        if (!unlink($imagePath)) {
            return back()->with('error', 'Failed to delete image file.');
        }
    }

    // Delete the post
    $post->delete();

    return redirect("/posts");
}

    
}
