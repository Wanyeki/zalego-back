@extends('layouts.app')
<!-- end nav -->
@section('content')
<link rel="stylesheet" href="{{asset('css/portfolio.css')}}">
<input type="hidden" name="" class="page_name" value="portfolio
 ">

    <div class="portfolio">
        <!-- <div class="landing_image">
            <img src="images/team.svg" alt="">
        </div> -->
        <div class="landing_image">
            <div class="landing-text" style="text-align: center;">Our Portfolio</div>
            <img src="images/pair.svg" alt="">
        </div>
            <div class="approach_wrapper">
                <div class="approach">
                    @foreach ($projects as $project)
                    <div class="step">
                        <div class="port-img">
                            <img src="{{$project->main_image}}" alt="" class="step-image">
                        </div>

                        <div class="top-landing-text">{{$project->title}}</div>
                        <p class="mission">
                            {{$project->short_description}}
                            <br> <button  class="btn more-port primary-btn" id="tab_{{$project->id}}" project_id="id_{{$project->id}}">more</button>
                            {{-- <button class="btn danger-btn  delete_project" id="id_{{$project->id}}">delete</button>
                            <button class="btn primary-btn more-port edit_project" id="edit-proj " project_id="id_{{$project->id}}">edit</button> --}}

                        </p>
                    </div>
                 @endforeach


                    </div>
                    </div>
                  </div>

                  <div class="tabs_wrapper">
                    @foreach ($projects as $project)
                    <div class="portfolio-more tab_{{$project->id}} animated faster slideInUp" >
                        <div class="close-port">
                            <img src="{{asset('images/icons8_close_window_50px.png')}}" alt="">
                        </div>
                        <div class="port-content">
                        <div class="top-landing-text">{{$project->title}}</div>
                        <p class="mission">{{$project->description}}</p>
                            <div class="top-landing-text"> Screenshots</div>
                            @if ($project->screenshot_type=='mobile')
                            <div class="mobile-screenshots">
                                @foreach ($screenshots[$project->id] as $screenshot)
                                    <img src="{{$screenshot}}" alt="">
                                @endforeach

                            </div>
                            @else
                            <div class="desk-screenshots">
                                @foreach ($screenshots[$project->id] as $screenshot)
                                <img src="{{$screenshot}}" alt="">
                               @endforeach
                            </div>
                            @endif
                            <div class="top-landing-text"> Product features</div>

                            {{-- features --}}
                            <div class="features">
                                <div class="feature">
                                    <div class="landing-par"><img src="{{asset('images/icons8_checked_checkbox_125px.png')}}" alt="">Registration Form </div>
                                    <div class="mission">The form will allow users to login into the system.
                                         We will further implement reset password feature to enable users retrieve their
                                         login credentials easily and “Remember me” features for the users interested in one time logins</div>
                                </div>

                            </div>

                            </div>
                    </div>
                    @endforeach

                </div>



            </div>
@endsection
