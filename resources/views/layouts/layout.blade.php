<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <link rel="shortcut icon" href="logo.png"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/mystyle.css">
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Kaushan+Script|Handlee" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="header-container">
        <div class="left-header">
          <div class="head-modal-burger">
            @if (Auth::check())
              <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
            @endif
          </div>
          <div class="logo" id="modal-opener">
            <p>PACLIPAN</p>
          </div>
        </div>
        <div class="right-header">
          <ul>
            <li class="active"><a href="/">About us</a></li>
            <li><a href="/food">Most popular</a></li>
            <li><a href="/company">Companies</a></li>
            <li class="nav-parent">
              <a href="#">
                @if (Auth::check())
                  <img src="/storage/images/{{Auth::user()->avatar}}" alt="">
                @else
                  <i class="material-icons">account_circle</i>
                @endif
              </a>
              <ul class="nav-drop">
                @if (Auth::check())
                  <a href="#"><li><i class="material-icons">restaurant</i> Reservations</li></a>
                  <a href="#"><li><i class="material-icons">favorite</i> Favorites</li></a>
                  @if (Auth::user()->role==0)
                    <a href="/register"><li><i class="material-icons">add</i> Company</li></a>
                  @else
                    <a href="/company-show-own"><li><i class="material-icons">business</i> My Company</li></a>
                  @endif
                  <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><li><i class="material-icons">exit_to_app</i> Logout</li></a>
                  <form action="/user" id="logout-form" method="post">
                    {{ csrf_field() }}
                  </form>
                @else
                  <a href="#" id="login-opener"><li><i class="material-icons">person</i> Login</li></a>
                  <a href="/register"><li><i class="material-icons">person_add</i> Register</li></a>
                  <a href="#"><li><i class="material-icons">favorite</i> Favorites</li></a>
                @endif
              </ul>
            </li>
            </div>
          </ul>
        </div>
      </div>
    </header>
    <section>
      <div class="content-container" id="app">
        <nav>
          <div class="nav-wrapper">
             <div class="col s12">
               <a href="#!" class="breadcrumb">First</a>
               <a href="#!" class="breadcrumb">Second</a>
               <a href="#!" class="breadcrumb">Third</a>
             </div>
          </div>
        </nav>
        @if(Auth::check() && Auth::user()->verified=='1')
        <div class="verification-input">
          <p><i class="material-icons">mail_outline</i> Please verify your email <span class="blue-text">{{Auth::user()->email}}</span> , Thank you.</p>
        </div>
        @endif
@if (Auth::check())
<ul id="slide-out" class="side-nav">
  <li>
    <div class="user-view">
    <div class="background">
      <img src="/DesignPic/teal.png">
    </div>
    <a href="#!user"><img class="circle" src="/storage/images/{{Auth::user()->avatar}}"></a>
    <a href="#!name"><span class="white-text name">{{Auth::user()->name}}</span></a>
    <a href="#!email"><span class="white-text email">{{Auth::user()->email}}</span></a>
    </div>
  </li>
    <li><a href="#!"><i class="material-icons">account_circle</i>First Link With Icon</a></li>
    <li><div class="divider"></div></li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!">First</a></li>
              <li><a href="#!">Second</a></li>
              <li><a href="#!">Third</a></li>
              <li><a href="#!">Fourth</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!">First</a></li>
              <li><a href="#!">Second</a></li>
              <li><a href="#!">Third</a></li>
              <li><a href="#!">Fourth</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li class="no-padding">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header">Dropdown<i class="material-icons">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a href="#!">First</a></li>
              <li><a href="#!">Second</a></li>
              <li><a href="#!">Third</a></li>
              <li><a href="#!">Fourth</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li><div class="divider"></div></li>
    <li><a class="subheader">Subheader</a></li>
    <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
  </ul>
    @endif
    <div class="main-content-container">
      @section('content')
      @show
    </div>
    <div id="login-modal">
      <login></login>
    </div>
  </div>
</section>
<footer>
  <div class="footer-container-top">
    <div class="left-footer">
      <h3>We promote your products & services 24/7 <i class="material-icons">access_time</i></h3>
      <h5>Be a member, join us!</h5>
      <h6>Register your catering restaurant <span class="highlight">HERE!</span></h6>
    </div>
    <div class="right-footer">
    </div>
  </div>
  <div class="footer-container-bot">
  </div>
</footer>
    <script type="text/javascript" src="/js/app.js">
    </script>
    <script type="text/javascript" src="/js/materialize.min.js">
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#login-opener').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').addClass('active');
      });
      $('#login-modal').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').removeClass('active');
      }).children().on('click',function(event)
      {
        event.preventDefault();
        return false;
      });
      // Initialize collapse button
      $(".button-collapse").sideNav();
      // Initialize collapsible (uncomment the line below if you use the dropdown variation)
      $('.collapsible').collapsible();
      $('.carousel.carousel-slider').carousel({fullWidth: true});
      });
      $('.modal').modal();
      $('select').material_select();
    </script>
  </body>
</html>
