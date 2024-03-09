<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
{

    $comments = $post->comments()->latest()->with('user')->get();
    $commentsNumber=$comments->count();
    return view('comments.index', compact('post','comments','commentsNumber'));


}

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);


        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return redirect()->route('home')->with('success', 'Comment has been added successfully.');
    }
}
