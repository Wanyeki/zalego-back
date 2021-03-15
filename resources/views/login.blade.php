@extends('layouts/app')
@section('content')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<input type="hidden" name="" class="page_name" value="login">
<div class="login-wrapper">
    <div class="qlogin" style="display: none"></div>


    <div class="real-login">
    <div class="login-left">

        <h2 class="title">Create Account</h2>

        <div class="icons">
        <div class="icon-wrapper"><span class="fa fa-google"></span></div>
        <div class="icon-wrapper"><span class="fa fa-facebook"></span></div>
        <div class="icon-wrapper"><span class="fa fa-twitter"></span></div>
        <div class="icon-wrapper"><span class="fa fa-github"></span></div>
        </div>
        <p>or use your email for registration</p>
        @if (@session('status'))
        <div class="feed">
                   {{@session('status')}}
                </div>
        @endif

        <form action="" method="post" action="/login">
            @csrf
            <input type="text" placeholder="username" name="username" class="x-input username" value="{{old('username')}}" style="@error('username')border:2px solid #FF4B4B @enderror">
            @error('username')
             <span class="error">{{$message}}</span>
            @enderror
            <input type="email" placeholder="email" name="email" class="x-input" value="{{old('email')}}" style="@error('email')border:2px solid #FF4B4B @enderror">
            @error('email')
            <span class="error">{{$message}}</span>
           @enderror
            <input type="password" placeholder="password" name="password" class="x-input"  style="@error('password')border:2px solid #FF4B4B @enderror">
            @error('password')
            <span class="error">{{$message}}</span>
           @enderror
            <input type="checkbox" name="remember" id="rem">
            <label for="rem"> Remember me</label> <br>
            <input type="submit" name="submit" value="Sign up" class="signup btn activ">
            <span class="btn login-tog">Sign in</span>
             <input type="submit" name="submit" value="Sign in" class="login btn activ" style="display: none">
        </form>

    </div>
    <div class="login-right" style="background-image: url('{{asset('images/loginback.png')}}')">
        <div class="h"></div>
    </div>
    </div>

    </div>
    <script src="{{asset('js/login.js')}}"></script>

@endsection
