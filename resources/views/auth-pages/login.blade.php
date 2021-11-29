@extends('layouts.authpages')
@section('title', 'meafrica')

@section('body')
<div class="authentication">
  <div class="container">
    <div class="row">
      <div data-v-9010385a="" class="col-lg-4 col-sm-12">
        <form action="{{route('auth.login')}}" method="POST" class="card auth_form ">
          @csrf
          <div class="header text-center"><img src="{{asset('images/logo.png')}}" alt="" width="100px" class="logo">
            <h5>Log in</h5>
          </div>
          @if(Session::get('error'))
            <div class="alert alert-danger">{{Session::get('error')}}</div>
          @endif
          <div class="body"><span class="small" style="display: none;"></span>
          @error('email') <span class="text-danger">{{$message}}</span> @enderror
            <div class="input-group mb-3">
              <input type="text" placeholder="Email" name="email" class="form-control" aria-required="true" aria-invalid="false" value="{{old('email')}}">
              <div class="input-group-append"><span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span></div>
            </div><span data-v-368309c4="" class="small text-danger" style="display: none;"></span>
            @error('password') <span class="text-danger">{{$message}}</span> @enderror
            <div class="input-group mb-3">
              <input type="password" placeholder="Password" name="password" class="form-control" aria-required="true" aria-invalid="false">
              <div class="input-group-append"><span class="input-group-text"><a href="forgot-password.html" title="Forgot Password" class="forgot"><i class="zmdi zmdi-lock"></i></a></span></div>
            </div>
            <div class="checkbox"><input id="remember_me" type="checkbox"><label for="remember_me">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN IN</button>
          </div>
        </form>
        <div class="copyright text-center"> © 2020, <span> Mission Enablers International </span></div>
      </div>

      <div class="col-lg-8 col-sm-12">
        <div class="card"><img src="{{asset('images/signup.svg')}}" alt="Sign In"></div>
      </div>
    </div>
  </div>
</div>
@endsection