@extends('layouts.app')
<!-- end nav -->
@section('content')
<link rel="stylesheet" href="{{asset('css/goals.css')}}">
<input type="hidden" name="" class="page_name" value="goals">

   <div class="goals">
    <div class="landing">
        <div class="header-left">
            <div class="landing-text">Our Goals <img src="images/icons8_services_80px.png" style="height: 40px;" alt=""></div>
            <div class="mission">The following are our goals</div>
            <div class="gls">
                @foreach ($content as $con)
                <div class="list">
                    <img src="images/icons8_checked_checkbox_125px.png" style="height: 50px;" alt="">
                    <div class="landing-par">{{$con->title}}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="header-right">
            <img src="images/goals.svg" alt="">
            </div>
        </div>
   </div>

   @endsection
