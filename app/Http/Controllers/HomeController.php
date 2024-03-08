<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $posts=Post::get();
        $friendsNumber = Friendship::where('first_user', auth()->user()->id)->count();
        $requestsNumber=Friendship::where('first_user',auth()->user()->id)->where('status','pending')->count();
        return view('dashboard',compact('posts','friendsNumber','requestsNumber'));
    }
}
