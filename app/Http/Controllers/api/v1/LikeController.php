<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(Request $request,Post $post)
    {
        $user_id = auth()->id();
        $post_id = $post->id;
        $existingLike = Like::where('user_id', $user_id)->where('post_id', $post_id)->first();

        if ($existingLike) {
            $existingLike->delete();
            return response()->json(['message' => 'Like removed successfully'], 200);
        } else {
            $like = Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
            return response()->json(['message' => 'Like added successfully'], 201);
        }
    }

    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);
        $likes = $post->likes()->with('user')->get();
        $likesNumber = $likes->count();
        return response()->json(['post' => $post, 'likes' => $likes, 'likesNumber' => $likesNumber], 200);
    }
}
