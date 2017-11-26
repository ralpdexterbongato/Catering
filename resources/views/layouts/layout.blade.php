<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <li class="active"><a href="#"><i class="material-icons">home</i></a></li>
            <li><a href="#"><i class="material-icons">restaurant_menu</i></a></li>
            <li><a href="#"><i class="material-icons">business</i></a></li>
            <div class="nav-login">
              <li><a href="#"><i class="material-icons">account_circle</i></a></li>
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
    <script type="text/javascript" src="/js/jquery.js">
    </script>
    <script type="text/javascript" src="/js/materialize.min.js">

    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      $('.parallax').parallax();
    });
    </script>
  </body>
</html>
