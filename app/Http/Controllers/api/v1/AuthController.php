<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;

class AuthController extends Controller
{

    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
                     'name' => 'required|string',
                     'email' => 'required|email|unique:users',
                    'password' => 'required|string|min:8',
                 ]);
                 if($validator->fails()){
                     return response()->json([
                         "Error"=>$validator->errors()
                     ], 400);
                 }
        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if($user->save()){
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return response()->json([
            'message' => 'Successfully created user!',
            'accessToken'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }
    public function login(Request $request)
{
    $validator=Validator::make($request->all(),[
        'email' => 'required|email',
       'password' => 'required',
    ]);
    if($validator->fails()){
        return response()->json([
            "Error"=>$validator->errors()
        ], 400);
    }

    $credentials = request(['email','password']);
    if(!Auth::attempt($credentials))
    {
    return response()->json([
        'message' => 'Unauthorized'
    ],401);
    }

    $user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->plainTextToken;

    return response()->json([
    'accessToken' =>$token,
    'token_type' => 'Bearer',
    ]);
}
public function user(Request $request)
{
    return response()->json($request->user());
}
public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json([
    'message' => 'Successfully logged out'
    ]);

}



    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $token = $user->createToken('Personal Access Token')->plainTextToken;
    //         return response()->json(['token' => $token], 200);
    //     } else {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:6',
    //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for image upload
    //         'bio' => 'nullable|string',
    //     ]);

    //     // Handle profile picture upload
    //     $profilePicturePath = null;
    //     if ($request->hasFile('profile_picture')) {
    //         $profilePicture = $request->file('profile_picture');
    //         $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
    //     }

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'profile_picture' => $profilePicturePath,
    //         'bio' => $request->bio,
    //     ]);

    //     $token = $user->createToken('Personal Access Token')->accessToken;
    //     return response()->json(['token' => $token], 201);
    // }
    // public function logout(){
    //     auth()->user()->tokens()->delete();

    //     return response()->json([
    //       "message"=>"logged out"
    //     ]);
    // }



    // public function register(Request $request)
    // {
    //     $validator=Validator::make($request->all(),[
    //         'name' => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:8',
    //     ]);
    //     if($validator->fails()){
    //         return response()->json([
    //             "Error"=>$validator->errors()
    //         ], 400);
    //     }

    //     $user = new User([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     $user->save();

    //     return response()->json([
    //         'message' => 'User successfully registered',
    //     ], 201);    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (!Auth::attempt($credentials)) {
    //         return response()->json(['message' => 'Unauthorized'], 401);
    //     }

    //     $user = Auth::user();

    //     $token = $user->createToken('auth-token')->plainTextToken;

    //     return response()->json(['access_token' => $token]);
    // }
}
