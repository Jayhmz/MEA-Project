<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Resources\UserResource;

class AuthController extends BaseController
{
     /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }

  /**
 * Get a JWT token via given credentials.
 *
 * @param  \Illuminate\Http\Request  $request
 *
 * @return \Illuminate\Http\JsonResponse
 */
  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required',
      'password' => 'required | min:6',
    ]);
    $credentials = $request->only('email', 'password');
    if ($token = auth()->attempt($credentials)) {
      return $this->respondWithToken($token);
    }

    return $this->sendError("Unauthorized", 401);
  }

  

  public function register(Request $request)
  {
    $request->validate([
      'password' => 'required | min:6',
    ]);
    $user = new User;
    $user->fill($request->post());
    /* if($request->hasFile('picture')) {
      $picture = Helper::fileUpload($request->picture);
      $user->picture = $picture;
    }
    if($request->hasFile('certificate_of_call_to_bar')) {
      $call_to_bar = Helper::fileUpload($request->certificate_of_call_to_bar, 'file');
      $user->certificate_of_call_to_bar = $call_to_bar;
    } */
    $user->password = bcrypt($request->password);
    if ($user->save()) {
      return $this->sendResponse(new UserResource($user), "data saved");
    }
  }


  /**
 * Log the user out (Invalidate the token)
 *
 * @return \Illuminate\Http\JsonResponse
 */
  public function logout()
  {
    auth()->logout();

    return $this->sendError("Unauthenticated", 401);
  }


  /**
 * Get the token array structure.
 *
 * @param  string $token
 *
 * @return \Illuminate\Http\JsonResponse
 */
  protected function respondWithToken($token)
  {
    return response()->json([
      'success' => true,
      'token' => $token,
      'token_type' => 'bearer',
      'data' => new UserResource($this->guard()->user()),
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }

  /**
 * Get the authenticated User
 *
 * @return \Illuminate\Http\JsonResponse
 */
  public function me()
  {
    return $this->sendResponse(new UserResource(auth()->user()), "Success");
  }

  /**
 * Get the guard to be used during authentication.
 *
 * @return \Illuminate\Contracts\Auth\Guard
 */
  public function guard()
  {
    return Auth::guard();
  }

  /**
 * Refresh a token.
 *
 * @return \Illuminate\Http\JsonResponse
 */
  public function refresh()
  {
    return $this->respondWithToken($this->guard()->refresh());
  }
}
