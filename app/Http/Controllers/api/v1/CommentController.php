<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function show($id): JsonResponse
    {
        $post=Post::findOrFail($id);
        $comments = $post->comments()->latest()->with('user')->get();
        $commentsNumber = $comments->count();

        return response()->json([
            'post' => $post,
            'comments' => $comments,
            'commentsNumber' => $commentsNumber
        ]);
    }

    public function store(Request $request, Post $post): JsonResponse
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return response()->json($comment, 201);
    }
}
