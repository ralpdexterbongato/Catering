@extends('layouts.layout')
@section('title')
 Request list
@endsection
@section('content')
  <requestlist :privacy="{{$privacyPrice}}"></requestlist>
@endsection
@section('javascripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
  <script src="/js/jquery.geocomplete.min.js" type="text/javascript"></script>
@endsection
