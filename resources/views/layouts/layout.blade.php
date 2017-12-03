<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/mystyle.css">
    <link rel="stylesheet" href="/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  </head>
  <body>
    <header>
      <div class="header-container">
        <div class="left-header">
          <div class="logo">
            PIXAR
          </div>
        </div>
        <div class="right-header">
          <ul>
            <li class="active"><a href="/"><i class="material-icons">home</i></a></li>
            <li><a href="/food"><i class="material-icons">restaurant_menu</i></a></li>
            <li><a href="/company"><i class="material-icons">business</i></a></li>
            <li class="nav-parent">
              <a href="#"><i class="material-icons">account_circle</i></a>
              <ul class="nav-drop">
                <a href="#"><li><i class="material-icons">person</i> Login</li></a>
                <a href="/register"><li><i class="material-icons">person_add</i> Register</li></a>
                <a href="#"><li><i class="material-icons">local_dining</i> Favorites</li></a>
              </ul>
            </li>
            </div>
          </ul>
        </div>
      </div>
    </header>
    <section>
      <div class="content-container">
        @section('content')
        @show
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
    });
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    </script>
  </body>
</html>
