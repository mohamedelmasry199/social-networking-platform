<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $old_image = $user->profile_picture;
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle profile picture update
        if (!$request->hasFile('profile_picture')) {
            $user->profile_picture = $old_image;
            $user->save();
        } else {
            $user->profile_picture = $this->uploadImage($request);
            $user->save();
        }
        if ($old_image && isset($request['profile_picture'])) {
            Storage::disk('public')->delete($old_image);
        }


        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    protected function uploadImage(Request $request){
        if(!$request->hasFile('profile_picture')){
            return;
        };
        $file =$request->file('profile_picture');
        $path=$file->store('uploads',['disk'=>'public']);
        return $path;
    }
}
