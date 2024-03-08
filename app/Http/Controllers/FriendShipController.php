<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendShipController extends Controller
{

    public function displayRequests()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Authentication failed.');
        }

        $userId = $user->id;

        $friendRequests = Friendship::with('user')
            ->where('second_user', $userId)
            ->where('status', 'pending')
            ->get();

        return view('friendShip.friendRequests', compact('friendRequests'));
    }

public function displayFriends($userId)
{
    $friends = Friendship::with('user')->where('second_user', $userId)
        ->where('status', 'confirmed')
        ->get();

    return view('friendShip.friends', compact('friends'));
}
public function acceptFriendRequest($friendshipId)
{
    $friendship = Friendship::findOrFail($friendshipId);
    $friendship->status = 'confirmed';
    $friendship->save();

    //Add both users to each other's friends list
    Friendship::create([
        'first_user' => $friendship->second_user,
        'second_user' => $friendship->first_user,
        'status' => 'confirmed',
    ]);

    return redirect()->back()->with('success', 'Friend request accepted successfully');
}


 public function deleteFriendRequest($friendshipId)
 {
     $friendship = Friendship::findOrFail($friendshipId);
     $friendship->delete();

     return redirect()->back()->with('success', 'Friend request deleted successfully');
 }
 public function sendRequest(Request $request)
 {
     $user = auth()->user();
     $friendId = $request->input('friend_id');

     if (!$user) {
         return redirect()->route('login')->with('error', 'Authentication failed.');
     }
     if ($user->id == $friendId) {
        return redirect()->back()->with('error', 'You cannot send a friend request to yourself.');
    }

     // Check if the friendship already exists (sent or received)
     $existingFriendship = Friendship::where(function ($query) use ($user, $friendId) {
         $query->where('first_user', $user->id)->where('second_user', $friendId);
     })->orWhere(function ($query) use ($user, $friendId) {
         $query->where('first_user', $friendId)->where('second_user', $user->id);
     })->first();

     if ($existingFriendship) {
         if ($existingFriendship->status === 'pending') {
             return redirect()->back()->with('error', 'Friend request already sent or received.');
         }
         return redirect()->back()->with('success', 'You are already friends.');
     }

     //new friendship
     $friendship = new Friendship();
     $friendship->first_user = $user->id;
     $friendship->second_user = $friendId;
     $friendship->status = 'pending';
     $friendship->save();

     return redirect()->back()->with('success', 'Friend request sent successfully');
 }


}
