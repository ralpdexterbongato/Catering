<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/mystyle.css">
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Pompiere" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Kaushan+Script|Handlee" rel="stylesheet">
  <body>
    @php
      function current_page($uri)
      {
        return strstr(request()->path(),$uri);
      }
    @endphp
    <header>
      <div class="header-container" id="notifyapp">
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
            <li class="{{current_page('/')?'active':''}}"><a href="/">Most popular</a></li>
            <li class="{{current_page('company') && current_page('company-show')==false?'active':''}}"><a href="/company">Companies</a></li>
            <li class="{{current_page('about') && current_page('company-show')==false?'active':''}}"><a href="/about">About us</a></li>
            @if (Auth::check())
            <div class="notif-icon-container">
              <notification :user="{{Auth::user()}}"></notification>
            </div>
            @endif
            <li class="nav-parent">
              <a href="#">
                @if (Auth::check())
                  <img src="/storage/images/{{Auth::user()->avatar}}" alt="">
                @else
                  <i class="material-icons">account_circle</i>
                  {{-- <a href="#" class="btn btn-floating pulse"><i class="material-icons">person</i></a> --}}
                @endif
              </a>
              <ul class="nav-drop">
                @if (Auth::check())
                  @if (Auth::user()->role==0)
                    <a href="/register"><li><i class="material-icons">add</i> Company</li></a>
                  @elseif(Auth::user()->role==1)
                    <a href="/package-create"><li><i class="material-icons">add</i> Package</li></a>
                    <a href="/company-show-own"><li><i class="material-icons">add</i> Product</li></a>
                    <div class="divider">
                    </div>
                    <a href="/comp-settings"><li><i class="material-icons">settings</i> Company</li></a>
                  @endif
                    <a href="/my-account-settings"><li><i class="material-icons">settings</i> Account</li></a>
                    <div class="divider">
                    </div>
                  @if(Auth::user()->role==1)
                    <a href="/company-show-own"><li><i class="material-icons">business</i> My Company</li></a>
                    <a href="/show-cater-request"><li><i class="material-icons">room_service</i>Catering request</li></a>
                  @endif
                  <a href="/calendar-show"><li><i class="material-icons">date_range</i> Schedule</li></a>
                  <div class="divider">
                  </div>
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
        @if(Auth::check() && Auth::user()->verified=='1')
        <div class="verification-input">
          <p><i class="material-icons">mail_outline</i> Please verify your email <span class="bold">{{Auth::user()->email}}</span> , Thank you.</p>
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
            @if (Auth::user()->role==2)
            <li><a class="subheader">Settings</a></li>
            @endif
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
    <script src="/js/jquery.js"></script>
    </script>
    <script src="https://unpkg.com/sweetalert2@7.1.2/dist/sweetalert2.all.js">
    </script>
    <script type="text/javascript" src="/js/app.js">
    </script>
    <script type="text/javascript" src="/notif/notif.js">
    </script>
    <script type="text/javascript" src="/js/materialize.min.js">
    </script>
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#login-opener-2').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').addClass('active');
      });
      $('#login-opener-3').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').addClass('active');
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
      $(".button-collapse").sideNav();
      $('.carousel.carousel-slider').carousel({fullWidth: true});
      $('.modal').modal();
      $('select').material_select();
      $('.collapsible').collapsible();
    });
    </script>
    @yield('javascripts')
  </body>
</html>
