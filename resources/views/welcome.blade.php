@extends('layouts.layout')
@section('title')
  Catering Services|Online
@endsection
@section('content')
  <div class="welcomepage-content-container">
    <div class="landing-hero-two">
      <div class="carousel carousel-slider center" data-indicators="true">
     <div class="carousel-fixed-item center">
       <a class="btn waves-effect orange darken-text-2" href="/food">Show more</a>
     </div>
     <div class="carousel-item red white-text" style="background: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.5)), url('/DesignPic/food1.jpg')" href="#one!">
       <h2>JJ's</h2>
       <p class="white-text">We have what all you want</p>
     </div>
     <div class="carousel-item amber white-text" style="background: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.5)), url('/DesignPic/food6.jpg')" href="#two!" >
       <h2>Monina's</h2>
       <p class="white-text">Our services are the best and better</p>
     </div>
     <div class="carousel-item green white-text" style="background: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.5)), url('/DesignPic/food8.jpg')" href="#three!">
       <h2>Third Panel</h2>
       <p class="white-text">This is your third panel</p>
     </div>
     <div class="carousel-item blue white-text" style="background: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.5)), url('/DesignPic/food11.jpg')" href="#four!">
       <h2>Fourth Panel</h2>
       <p class="white-text">This is your fourth panel</p>
     </div>
   </div>
    </div>
    <div class="short-about-container">
      <div class="about-left">
        <h1>OUR STORY</h1>
        <p>Lorem ipsum dolor sit amet,t labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <h6>ABOUT US</h6>
      </div>
      <div class="about-right">
        <div class="image-about-container">
          <img src="/DesignPic/food1.jpg" alt="about">
        </div>
      </div>
    </div>
    <div class="most-ordered-dish-container">
      <div class="most-ordered-left">
        <div class="most-ordered-container">
          <div class="imageDish">
            <img src="/DesignPic/1.jpg" alt="">
          </div>
          <div class="imageDish">
            <img src="/DesignPic/food2.jpg" alt="">
          </div>
        </div>
        <div class="most-ordered-container">
          <div class="imageDish">
            <img src="/DesignPic/food3.jpg" alt="">
          </div>
          <div class="imageDish">
            <img src="/DesignPic/food1.jpg" alt="">
          </div>
        </div>
      </div>
      <div class="most-ordered-right">
        <h1>TOP FAVORITE</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
  </div>
@endsection
