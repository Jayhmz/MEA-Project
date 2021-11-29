<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AdminUser
{
  
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
      if (!$request->session()->has('admin') && $request->query('key')==null) {
        return redirect()->away('http://localhost:8080/login');
      }
    
    if (!$request->session()->has('admin')) {
      $token = JWTAuth::setToken($request->query('key'));
      $details = collect(JWTAuth::getPayload($token)->toArray()['details']);
      
      $user = User::where('email', $details['email'])->first();
      if (!Hash::check($details['password'], $user->password)) {
        return redirect()->away('http://localhost:8080/login');
      } else {
        $request->session()->put('admin', $user->first());
      }
    }
    return $next($request);
  }
}
