@extends('layouts.app')
<!-- end nav -->
@section('content')
<link rel="stylesheet" href="{{asset('css/sets_us.css')}}">
<input type="hidden" name="" class="page_name" value="sets">

<div class="landing_image">
    <div class="landing-text" style="text-align: center;">What sets us apart</div>
    <img src="images/team.svg" alt="">
</div>
    <div class="approach_wrapper">
        <div class="approach">
            @foreach ($content as $con)
            <div class="step">
                <img src="{{$con->icon}}" alt="" class="step-icon">
                <div class="top-landing-text">{{$con->title}}</div>
                <p class="mission">
                    {{$con->description}}
                </p>
            </div>
  @endforeach

            </div>
     </div>
   @endsection
