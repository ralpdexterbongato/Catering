@extends('layouts.layout')
@section('title')
Company Profile
@endsection
@section('content')
  @if (Auth::check())
    <companyprofile :user="{{Auth::user()}}" :company="{{$CompanyData}}"></companyprofile>
  @else
    <companyprofile :company="{{$CompanyData}}"></companyprofile>
  @endif

@endsection
@section('javascripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
  <script src="/js/jquery.geocomplete.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  var locations = <?php print_r(json_encode($mapdata)) ?>;
    $(document).ready(function() {
      var mymap = new GMaps({
         el: '#company-profile-map',
         lat: locations[0].lat,
         lng: locations[0].lng,
         zoom:15
       });

    $.each( locations, function( index, value ){
	   mymap.addMarker({
	      lat: value.lat,
	      lng: value.lng,
	      title: 'Our company`s location'
	    });
   });
});
  </script>
@endsection
