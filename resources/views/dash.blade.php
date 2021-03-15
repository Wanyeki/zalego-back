@extends('layouts/app')
@section('content')

<link rel="stylesheet" href="{{asset('css/portfolio.css')}}">
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<input type="hidden" name="" class="page_name" value="dash">
<input type="hidden" name="" value='xxxxxxxx' class="the_id">
    <div class="dash-wrapper">

        <div class="side-left">
        <div class="navigation">
            <div class="logoandtitle" style="text-align: center;">
                <img src="{{asset('images/logo.png')}}" alt="" style="width:60px">
                <h3>Zalego Enterprise</h3>
            </div>

            <div class="side-item selected" id="dash">
                <span class="fa fa-signal"></span>
                 <h4 class="side-title">Dash</h4>
             </div>
            <div class="side-item" id="users">
                <span class="fa fa-user"></span>
                 <h4 class="side-title">Users/admins</h4>
             </div>
            <div class="side-item"id="portfolio">
                <span class="fa fa-tasks" ></span>
                 <h4 class="side-title">Portfolio</h4>
             </div>
             <div class="side-item" id="partners">
                <span class="fa fa-user"></span>
                 <h4 class="side-title">Partners</h4>
             </div>
            <div class="side-item" id="goals">
                <span class="fa fa-bullseye"></span>
                 <h4 class="side-title">Sections content</h4>
             </div>
             <div class="side-item" id="email">
                <span class="fa fa-envelope"></span>
                 <h4 class="side-title">Email/messages</h4>
             </div>
             <div class="side-item" >
                <span class="fa fa-home"></span>
                 <h4 class="side-title">Homepage</h4>
             </div>



        </div>
    </div>
    <div class="side-right">
        <div class="topbar">
            <h2>Dashboard[admin]</h2>
            <div class="user-info" style="display: flex; align-items: center; margin-right: 20px; cursor: pointer;">
                <div class="avatar">
                    <img src="{{asset('images/avatar.png')}}" alt="">
                </div>
                <form action="{{route('logout')}}" method="POST" style="margin-left: 10px">
                    @csrf
                    <input type="submit" class="nav-link active btn" value="logout {{auth()->user()->name}}">
                </form>
            </div>


        </div>
        <div class="stacks">
            <div class="dash window" style="display:block">
                <div class="count_tabs">
                    <div class="count_tab">
                      <div class="count_left">
                          <img src="{{asset('images/icons8_transaction_50px_1.png')}}" alt="">
                          <div class="count_title "> <span class="ls_tm">total users</span> </div>
                      </div>
                      <div id="last_tb" class="count_right">{{$counts['users_count']}}</div>
                    </div>
                    <div class="count_tab">
                      <div class="count_left">
                          <img src="{{asset('images/icons8_money_50px.png')}}" alt="">
                          <div class="count_title"> <span class="ths_tm">subscribed to newsletter</span></div>
                      </div>
                      <div id="this_payable" class="count_right "> 0</div>
                    </div><div class="count_tab">
                      <div class="count_left">
                          <img src="{{asset('images/icons8_transaction_50px_1.png')}}" alt="">
                          <div class="count_title"><span class="ths_tm">total projects</span></div>
                      </div>
                      <div id="this_paid" class="count_right ">{{$counts['projects_count']}}</div>
                    </div><div class="count_tab">
                      <div class="count_left">
                          <img src="{{asset('images/icons8_transaction_50px_1.png')}}" alt="">
                          <div class="count_title">  <span class="ths_tm">Total Partners</span> </div>
                      </div>
                      <div id="this_balance" class="count_right ">{{$counts['partners_count']}}</div>
                    </div>
                    <div class="count_tab">
                      <div class="count_left">
                          <img src="{{asset('images/icons8_transaction_50px_1.png')}}" alt="">
                          <div class="count_title">verified email</div>
                      </div>
                      <div id="total_balance" class="count_right "> 0</div>
                    </div>

                    <!-- <div class="count_tab">
                      <div class="count_left">
                          <img src="{{asset('images/icons8_transaction_50px_1.png')}}" alt="">
                          <div class="count_title"> Cash at bank</div>
                      </div>
                      <div id="asset_value" class="count_right"> 0</div>
                    </div> -->



                </div>
            </div>
            <div class="users window">

                <div class="users_wrapper">
                    <div class="users_left">
                        <div class="users_table">
                        <table >
                            <thead>
                            <tr><th>username</th><th>email</th>  <th>verified</th> <th>type</th>  </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan="4"><img src="{{asset('images/loader.gif')}}" alt="" style="width: 100%;height:400px"></td></tr>
                        </tbody>
                        </table>
                    </div>
                        <div class="bottom-btns">
                          <button class="btn primary-btn edit_user">Edit</button>
                          <button class="btn danger-btn delete_user">Delete</button>
                          <button class="btn primary-btn make_admin">Make Admin</button>
                        </div>

                    </div>
                    <div class="users_right">
                        <div class="users_form">
                            <h3 class="title">New User</h3>
                            <input type="text" class="x-input usern" placeholder="username">
                            <input type="text" class="x-input userem" placeholder="email">
                           <button class="btn save_user primary-btn">add</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="portfolio window">
                <div class="port-wrapper">
                    <div class="port-left">

                        <div class="port-form">
                            <h3 class="title">Add a project</h3>
                            <form action="/add_project" method="post" enctype="multipart/form-data">
                                @csrf
                            <input type="text" class="x-input" placeholder="title" name="title">
                            <textarea name="short_description" id="" cols="50" rows="4" class="shortd" placeholder="short description"></textarea>
                            <textarea name="description" id="" cols="50" rows="7" class="longd" placeholder="description"></textarea>
                            <div class="file-input">
                            <label for="main-img">main image</label>
                            <input type="file" name="main_image" id="main-img"></div>

                            <div class="file-input">
                            <label for="screens">Screenshots</label>
                            <input type="file" name="screenshots[]" id="screens" multiple>

                            </div>
                            <div class="file-input">
                                <label for="scr">screnshot type</label>
                                <select id="scr" name="screenshot_type">
                                    <option value="mobile">Mobile</option>
                                    <option value="desktop">Desktop/web</option>

                                </select>
                            </div>
                            <input type="submit" value="save" name="save_project" class="btn primary-btn">

                        </form>

                        </div>
                    </div>
                    <div class="port-right">
                        <div class="approach">
                            @foreach ($projects as $project)
                            <div class="step">
                                <div class="port-img">
                                    <img src="{{$project->main_image}}" alt="" class="step-image">
                                </div>

                                <div class="top-landing-text">{{$project->title}}</div>
                                <p class="mission">
                                    {{$project->short_description}}
                                    <br> <button  class="btn more-port primary-btn" id="tab_{{$project->id}}" project_id="id_{{$project->id}}">view</button>
                                    <button class="btn danger-btn  delete_project" id="id_{{$project->id}}">delete</button>
                                    <button class="btn primary-btn more-port edit_project" id="edit-proj " project_id="id_{{$project->id}}">edit</button>

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
                    <div class="portfolio-more edit-proj animated faster slideInUp" >

                        <div class="close-port">
                            <img src="{{asset('images/icons8_close_window_50px.png')}}" alt="">
                        </div>
                        <div class="port-content"><div class="top-landing-text">Edit project</div>
                            <div class="edit-port-wrapper ">

                                <div class="port-form">
                                <form action="/update_project" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <h3 class="title">Edit description</h3>
                                <input type="text" class="x-input pro_title" placeholder="title" name="title">
                                <textarea name="short_description" class="pro_short_description" id="" cols="80" rows="4" class="shortd" placeholder="short description"></textarea>
                                <textarea name="description" id="" class="pro_description" cols="80" rows="7" class="longd" placeholder="description"></textarea>
                                <div class="file-input">
                                <label for="main-img">main image</label>
                                <input type="file" name="main_image" id="main-img"></div>

                                <div class="file-input">
                                <label for="screens">Screenshots</label>
                                <input type="file" name="screenshots" id="screens" multiple>
                                </div>
                                <input type="submit" value="update" name="update_project" class="btn primary-btn">

                            </form>
                        </div>
                        <div class="features-form port-form">
                            <h3 class="title">Add product features</h3>
                            <input type="text" class="x-input feature_title" placeholder="title" name="title">
                            <textarea name="description" id="" cols="50" rows="4" class="feature_description" placeholder=" description"></textarea>
                            <button class="btn primary-btn add_feature">add</button>
                        </div>
                            </div>
                            <div class="features_preview">
                                <div class="top-landing-text"> Product features</div>

                                {{-- features --}}
                                <div class="features">


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="partners window">
                <div class="partners-wrapper">
                    <div class="part-left">
                        <div class="part-cards">
                            @foreach ($partners as $partner)
                        <div class="part-card">
                            <div class="img-logo">
                                <img src="{{$partner->logo}}" alt="">
                            </div>
                            <div class="mission">{{$partner->name}}</div>
                            <button class="btn danger-btn delete_partner" id="id_{{$partner->id}}">delete</button>

                        </div>
                         @endforeach
                    </div>
                    </div>
                    <div class="part-right">
                        <div class="part-form">
                            <form action="/add_partner" method="post" enctype="multipart/form-data">
                                @csrf
                            <h3 class="title">Add Partners</h3>
                            <input type="text" name="name" class="x-input" placeholder="name">
                            <label for="part-logo"> logo</label>
                            <input type="file" name="logo" id="">
                            <button class="btn primary-btn">save</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="goals window" >
                <div class="dash-goal"style="height: 100%">
                <div class="goals-form port-form" style="height: 70%; width:360px">
                    <form action="/save_content" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="goal_type">Select section</label>
                        <select name="type" id="goal_type" class="x-selector goal_type">
                            <option value="approach">Approach</option>
                            <option value="sets">What sets us appart</option>
                            <option value="capability">Capability Statement</option>
                            <option value="goal">Goals</option>
                        </select>
                        <input type="text" class="x-input cont_description" placeholder="title" name="title">
                        <textarea name="description" id="" class="" cols="40" rows="7" class="longd" placeholder="description"></textarea>
                        <div class="file-input cont_file">
                            <label for="main-img">icon</label>
                            <input type="file" name="icon" id="main-img">
                        </div>
                        <input type="submit" value="save" name="save_content" class="btn primary-btn">

                    </form>
                </div>
                <div class="dash-goal-preview" style="height: 100%">

                    <div class="approach dash-contents" style="height: 100%; overflow:auto">

                    </div>
                </div>
            </div>
        </div>
            <div class="window email">
                <div class="message_wrapper">
                    <div class="message_left">
                        <h3 class="title">
                            Messages
                        </h3>
                        <div class="conts">

                        </div>
                    </div>
                    <div class="message_right">
                           <div class="messages_top" style="display: none">
                               <div class="av">
                            <div class="avatar ">
                                <img src="{{asset('images/avatar.png')}}" alt="">
                            </div></div>
                            <div class="av_left">
                                <div class="subject av_email"></div>
                                <div class="av_name"></div>
                            </div>

                           </div>

                           <div class="message_body" style="display: none">
                               <h4 class="titl" style="text-align: left"></h4>
                               <p class="mission body">
                               </p>
                           </div>
                           <div class="message_form port-form">
                                <div class="title nw">Create Newsletter </div>
                                <input type="text" class="x-input" placeholder="title">
                                <textarea name="" id="" cols="60" rows="10" placeholder="body"></textarea>
                            <br>    <button class="btn primary-btn ">send to email</button>
                           </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="qdash" style="display: none"></div>
    </div>
    </div>
     @if (@session('tab'))
    <script>
        setTimeout(()=>{
            document.querySelector('#{{@session('tab')}}').click();
        },100)


    </script>
    @endif
    <script src="{{asset('js/dash.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
@endsection
