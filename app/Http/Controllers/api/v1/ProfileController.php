<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Responses\ApiResponse;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the specified user profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return ApiResponse::success($users);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return ApiResponse::success($user);
    }

    /**
     * Update the specified user profile.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
{
    $user = $request->user();
    $old_image = $user->profile_picture;
    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/uploads'), $fileName);
        $user->profile_picture = 'storage/uploads/' . $fileName;
        if ($old_image) {
            Storage::disk('public')->delete($old_image);
        }
    }
    $user->save();

    return ApiResponse::success($user, 'Profile updated successfully');
}
    /**
     * Remove the specified user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

}
