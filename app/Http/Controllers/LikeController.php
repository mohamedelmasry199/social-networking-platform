<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        // Assuming user is authenticated and you get user_id from authentication
        $user_id = auth()->id();
        $post_id = $request->post_id;
        $existingLike = Like::where('user_id', $user_id)->where('post_id', $post_id)->first();
        if ($existingLike) {
            // User has already liked the post, so remove the like (unlike)
            $existingLike->delete();
            return response()->json(['message' => 'Like removed successfully']);}
        else{
        $like=Like::create([
            'user_id' => $user_id,
            'post_id' => $request->post_id,
        ]);
        return redirect()->route('home')->with('success', 'Like added successfully');


    }

    }
    public function showLikes(Post $post)
    {
        $likes = $post->likes()->with('user')->get();
        $likesNumber=$likes->count();
        return view('likes.index', compact('post', 'likes','likesNumber'));
    }
}
