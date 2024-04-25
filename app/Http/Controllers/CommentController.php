<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
class CommentController extends Controller
{
   

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
    
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    
    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
    
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
    }
