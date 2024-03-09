<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
{
    return view('posts.create');
}
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'content' => 'required|string',
        'title'=>'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
        $validatedData['image'] = $imagePath;
    }

    $validatedData['user_id'] = auth()->user()->id;

    Post::create($validatedData);

    return redirect()->route('home')->with('success', 'Post created successfully.');
}

    public function edit($id){
        $post=Post::findOrFail($id);
        return view('posts.edit',compact('post'));

    }
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:200048',
        ]);

        // Check if the request has an image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $validatedData['image'] = $imagePath;
        }

        $post->update($validatedData);

        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }
    public function userPosts(){
        $userId=auth()->user()->id;
        $posts=Post::where('user_id',$userId)->paginate(5);
        return view('posts.userPosts',compact('posts'));

    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            // Delete the image associated with the post
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }

}
