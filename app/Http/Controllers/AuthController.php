<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $token = auth()->attempt($request->only('email', 'password'));
        // $token = auth()->attempt($request->only('email', 'password'));
    
        return response()->json([
            'message'=>'inserted succesfully',
            'user' => $user
        ]);
    }
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    
    try {
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    } catch (JWTException $e) {
        return response()->json(['error' => 'Could not create token'], 500);
    }
    
    return response()->json(['token' => $token]);
}

//   protected function respondWithToken($token)
//   {
//     return response()->json([
//         'access_token'=>$token,
//         'token_type'=>'bearer',
//         // 'expires_in'=>auth()->factory()->getTTL()*60
//     ]);
//   } 
  public function user()
  {
    $user = auth()->user();
    return response()->json(['user' => $user]);
  } 
  public function logout()
{
    // Get the authenticated user
    $user = Auth::guard('api')->user();

    // Invalidate the current token
    JWTAuth::manager()->invalidate(JWTAuth::getToken());

    // Perform any additional logout logic if needed

    return response()->json(['message' => 'Successfully logged out']);
}
}
