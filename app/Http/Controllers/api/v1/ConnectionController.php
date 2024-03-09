<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Friendship;
use App\Models\User;

class ConnectionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Authentication failed.'], 401);
        }

        $friendRequests = $user->receivedFriendRequests;

        return response()->json(['friendRequests' => $friendRequests], 200);
    }

    public function show($userId)
    {
        $friends = Friendship::with('user')->where('second_user', $userId)
            ->where('status', 'confirmed')
            ->get();

        return response()->json(['friends' => $friends], 200);
    }

    public function acceptRequest($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);
        $friendship->status = 'confirmed';
        $friendship->save();

        // Add both users to each other's friends list
        Friendship::create([
            'first_user' => $friendship->second_user,
            'second_user' => $friendship->first_user,
            'status' => 'confirmed',
        ]);

        return response()->json(['message' => 'Friend request accepted successfully'], 200);
    }

    public function destroy($friendshipId)
    {
        $friendship = Friendship::findOrFail($friendshipId);
        $friendship->delete();

        return response()->json(['message' => 'Friend request deleted successfully'], 200);
    }

    public function store(Request $request,$friendId)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Authentication failed.'], 401);
        }

        if ($user->id == $friendId) {
            return response()->json(['error' => 'You cannot send a friend request to yourself.'], 422);
        }

        $existingFriendship = Friendship::where(function ($query) use ($user, $friendId) {
            $query->where('first_user', $user->id)->where('second_user', $friendId);
        })->orWhere(function ($query) use ($user, $friendId) {
            $query->where('first_user', $friendId)->where('second_user', $user->id);
        })->first();

        if ($existingFriendship) {
            if ($existingFriendship->status === 'pending') {
                return response()->json(['error' => 'Friend request already sent or received.'], 422);
            }
            return response()->json(['message' => 'You are already friends.'], 200);
        }

        $friendship = new Friendship();
        $friendship->first_user = $user->id;
        $friendship->second_user = $friendId;
        $friendship->status = 'pending';
        $friendship->save();

        return response()->json(['message' => 'Friend request sent successfully'], 201);
    }
}
