@extends('layouts.layout')
@section('title')
  Featured Menu
@endsection
@section('content')
  <div class="menu-index-container">
    @foreach ($popularFoods as $key => $food)
    <div class="menu-container z-depth-2">
      <div class="menu-box">
        <img src="/storage/images/{{$food->image}}" alt="">
        <div class="mini-box">
          <h5>{{$food->name}}</h5>
          <p>{{$food->description}}</p>
        </div>
      </div>
      <div class="menu-bottom">
        <div class="menu-left-buttons">
          <a href="/company-show/{{$food->company->id}}"><h5>{{$food->company->name}}</h5></a>
        </div>
        <div class="menu-right-buttons">
          <ul>
            <a href="#"><li><i class="material-icons">person</i><p>{{$food->RequestCount}}</p></li></a>
          </ul>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="pagination-container-popular">
    {{$popularFoods->links()}}
  </div>
@endsection
