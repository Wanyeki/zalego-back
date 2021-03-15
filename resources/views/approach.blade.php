@extends('layouts.app')
<!-- end nav -->
@section('content')
<input type="hidden" name="" class="page_name" value="approach">
    <div class="landing_image">
        <link rel="stylesheet" href="{{asset('css/approach.css')}}">
        <div class="landing-text" style="text-align: center;">Our Approach</div>
        <img src="images/goals.svg" alt="">
    </div>
    <div class="approach_wrapper">

        <div class="approach">
            @foreach ($content as $con)
            <div class="step">
                <img src="/images/icons8_cloud_development_50px.png" alt="" class="step-icon">
                <div class="top-landing-text">{{$con->title}}</div>
                <p class="mission">
                    {{$con->description}}
                     <div class="arrow">
                      <div class="step_number">{{$con->step}}</div>
                    </div>
        </p>
            </div>
            @endforeach
        </div>
    </div>

   @endsection()
