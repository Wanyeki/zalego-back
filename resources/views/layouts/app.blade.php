<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#3F75F6">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Zalego</title>
	<link rel="icon" href="{{asset('images/logo.png')}}">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
	<link rel="stylesheet" href="{{asset('pack/glider.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	<div class="navbar fixed">
    <div class="nav">
        <div class="nav-left">
            <a href="index.html" class="brand-link">
                <img src="images/logo.png" alt="" class="brand-logo">
                 <div class="brand-title">
                        Zalego Enterprise
                 </div>
                </a>

            <div class="toogle-nav">
                <!-- <a href=""> <li class="small-nav-link active">link 1</li> </a> -->
                <div class="menu-control">
               <img src="{{asset('images/icons8_squared_menu_50px.png')}}" alt="..." class="menu">
               <img src="{{asset('images/icons8_close_window_50px.png')}}" alt="X" class="cancel">
            </div>
            </div>
        </div>
        <div class="nav-right">
            <ul class="nav-links">
				<a href="/"> <li class="nav-link qhome">Home</li> </a>
				<a href="{{route('sets')}}"> <li class="nav-link qsets">What sets us apart</li> </a>
				<a href="{{route('approach')}}"> <li class="nav-link qapproach">Our approach</li> </a>
				<a href="{{route('goals')}}"> <li class="nav-link qgoals">Goals</li> </a>
				<a href="{{route('portfolio')}}"> <li class="nav-link qportfolio">Portfolio</li> </a>
                <a href="{{route('contacts')}}"> <li class="nav-link qcontacts">Contact</li> </a>
                @if (auth()->user())
                @if (auth()->user()->type=='admin')
                <a href="{{route('dash')}}"> <li class="nav-link qadmin">Dashboard</li> </a>
                @endif @endif
				<div class="btn-wrapper">
                    @guest
                        <a href="{{route('login')}}"> <li class="nav-link active btn">login</li> </a>
                    @endguest
				@auth
                    <form action="/logout" method="POST">
                    @csrf
                    <input type="submit" class="nav-link active btn" value="logout">
                </form>
                @endauth

            </div>
            </ul>
        </div>
	</div>
</div>
<input type="hidden" name="" value='xxxxxxxx' class="the_id">

@yield('content')

<footer >
    <div class="footer-top">

        <div class="footer-contact">
            <h2 class="top-landing-text">
               Contact Us
            </h2>
            <div class="contact mission">
                <img src="{{asset('images/icons8_marker_50px.png')}}" alt="">
                Devan Plaza, 3rd Floor Crossway, Westlands Nairobi, Kenya
            </div>
            <div class="contact mission">
                <img src="{{asset('images/icons8_phone_50px.png')}}" alt="">
                +254 720 561 146
            </div>
            <div class="contact mission">
                <img src="{{asset('images/icons8_secured_letter_50px.png')}}" alt="">
                <span>eric@zalego.com</span>

            </div>

        </div>
        <div class="news-letter">
            <h2 class="top-landing-text">
                Subscribe to our Newsletter
            </h2>
            <p class="mission" >
                Get in your inbox the latest News from us
            </p>

                <div class="nemail">
                    <input type="text" class="news-email" placeholder="Email">
                    <img src="{{asset('images/icons8_right_arrow_50px.png')}}" class="add_newsletter" alt="">
                </div>
                <p class="mission">
                    We'll never share your email address
                </p>
        </div>

    </div>
    <h2 class="top-landing-text">
        Quick Links
    </h2>
    <div class="ql">
        <a href="{{route('home')}}" class="contact"> <img src="{{asset('images/icons8_home_30px.png')}}" height="20" alt=""> <span>Home</span></a>
        <a href="{{route('approach')}}"  class="contact"> <img src="{{asset('images/icons8_workflow_30px.png')}}" height="20" alt=""><span>Our approach</span></a>
        <a href="{{route('goals')}}"class="contact" > <img src="{{asset('images/icons8_goal_30px_3.png')}}" height="20" alt=""><span>Goals</span></a>
        <a href="{{route('portfolio')}}"class="contact"> <img src="{{asset('images/icons8_project_30px_1.png')}}" height="20" alt=""><span>Our portfolio</span></a>
        <a href="{{route('sets')}}"class="contact"> <img src="{{asset('images/icons8_team_30px_1.png')}}" height="20" alt=""><span>What sets us appart</span></a>
        <a href="{{route('contacts')}}"class="contact"> <img src="{{asset('images/icons8_call_30px.png')}}" height="20" alt=""><span>Contact us</span></a>
    </div>
    <div class="footer-bottom mission">
        All Rights Reserved. © 2020 Zalego
    </div>
</footer>
<!-- social -->
<div class="social">
    <div class="social_links">
        <div class="social-icon"><img src="{{asset('images/icons8_facebook_100px.png')}}" alt=""></div>
        <div class="social-icon"><img src="{{asset('images/icons8_twitter_circled_100px.png')}}" alt=""></div>
        <div class="social-icon"><img src="{{asset('images/icons8_play_button_100px_1.png')}}" alt=""></div>
    </div>
</div>

</body>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
<script src="pack/glider.min.js"></script>
<script src="{{asset('js/index.js')}}"></script>
</html>

