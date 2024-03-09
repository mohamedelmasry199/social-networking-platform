<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts=Post::latest()->paginate();
        $friendsNumber = Friendship::where('first_user', auth()->user()->id)->where('status','confirmed')->count();
        $requestsNumber=Friendship::where('second_user',auth()->user()->id)->where('status','pending')->count();
        return view('dashboard',compact('posts','friendsNumber','requestsNumber'));
    }
    public function search(Request $request){
        $query = $request->input('query');

        $users = User::where('name', 'like', "%$query%")->get();

        return view('posts.searchResult', compact('users'));
    }


}


