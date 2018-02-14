@extends('layouts.layout')
@section('title')
  Register | Join us
@endsection
@section('content')
<div class="registerpage-container">
@if (Auth::check())
  <register :user="{{Auth::user()}}"></register>
@else
  <register></register>
@endif
</div>
@endsection
@section('javascripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
  <script src="/js/jquery.geocomplete.min.js" type="text/javascript"></script>
  @if (Auth::check())
    <script type="text/javascript">
    var map= new google.maps.Map(document.getElementById('map-canvas'),{
      center:{
        lat:27.72,
        lng:85.36
      },
      zoom:15
    });
    $("#searchgmap").geocomplete({
      map:map,
      markerOptions: {
        draggable: true
      }
    }).bind('geocode:result',function(e, result){
      var lat = marker.getPosition().lat();
      var lng = marker.getPosition().lng();
      $('#lat').val(lat);
      $('#lng').val(lng);
    });
    var marker = $("#searchgmap").geocomplete("marker");
    google.maps.event.addListener(marker,'dragend',function(){
      console.log(marker.getPosition().lat());
      var lat = marker.getPosition().lat();
      var lng = marker.getPosition().lng();
      $('#lat').val(lat);
      $('#lng').val(lng);
    });
    </script>
  @endif
@endsection
