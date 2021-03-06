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
    <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
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
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
            <div class="notif-icon-container">
              @if (Auth::check())
              <notification :user="{{Auth::user()}}"></notification>
              @endif
            </div>
          </div>
          <div class="logo" id="modal-opener">
            <p>Catering Services</p>
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
              <a href="#" v-on:click.prevent>
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
          <p><i class="material-icons">mail_outline</i> Please verify <span class="bold">{{Auth::user()->email}}</span> , Thank you. <a href="/resend-email">resend</a></p>
        </div>
        @endif

        <ul id="slide-out" class="side-nav">
          <li>
            <div class="user-view">
            <div class="background red">
            </div>
            @Auth
            <a><img class="circle" src="/storage/images/{{Auth::user()->avatar}}"></a>
            <a><span class="white-text name">{{Auth::user()->name}}</span></a>
            <a><span class="white-text email">{{Auth::user()->email}}</span></a>
            @endAuth
            </div>
          </li>
            <li><a href="/"><i class="material-icons">star_border</i>Popular</a></li>
            <div class="divider"></div>
            <li><a href="/company"><i class="material-icons">store</i>Companies</a></li>
            <div class="divider"></div>
            <li><a href="/about"><i class="material-icons">info</i>About us</a></li>
            <div class="divider"></div>
            <li><a class="subheader">Account</a></li>
            @if (Auth::check()==false)
              <li><a href="#" v-on:click.prevent id="login-opener4"><i class="material-icons">person</i>Login</a></li>
              <li><a href="/register"><i class="material-icons">person_add</i>Register</a></li>
            @else
              <li><a href="/my-account-settings"><i class="material-icons">settings</i>Settings</a></li>
              <div class="divider"></div>
            @endif
            @if (Auth::check() && Auth::user()->role==0)
              <li><a class="subheader">Company</a></li>
              <li><a href="/register"><i class="material-icons">add</i>Register</a></li>
            @endif
            @if (Auth::check() && Auth::user()->role==1)
              <li><a class="subheader">Company</a></li>
              <li><a href="/comp-settings"><i class="material-icons">settings</i>Settings</a></li>
              <li><a href="/package-create"><i class="material-icons">add</i>Package</a></li>
              <li><a href="/company-show-own"><i class="material-icons">add</i>Product</a></li>
              <li><a href="/show-cater-request"><i class="material-icons">room_service</i>Catering request</a></li>
            @endif
            @if (Auth::check())
              <li><a href="/calendar-show"><i class="material-icons">date_range</i>Schedule</a></li>
              <li><div class="divider"></div></li>
              <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i>Logout</a></li>
            @endif
          </ul>
    <div class="main-content-container">
      @section('content')
      @show
    </div>
    <div id="login-modal">
      <login></login>
    </div>
  </div>
  <div id="dark-modal-closer">

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
        $('#dark-modal-closer').addClass('active');
      });
      $('#login-opener-3').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').addClass('active');
        $('#dark-modal-closer').addClass('active');
      });
      $('#login-opener').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').addClass('active');
        $('#dark-modal-closer').addClass('active');
      });
      $('#login-opener4').on('click',function(event)
      {
        event.preventDefault();
        $('#login-modal').addClass('active');
        $('#dark-modal-closer').addClass('active');
      });
      $('#dark-modal-closer').click(function(event)
      {
        $('#login-modal').removeClass('active');
        $('#dark-modal-closer').removeClass('active');
      });
      $('.main-content-container > #login-modal').on('click',function(event)
      {
        $('#login-modal').removeClass('active');
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
