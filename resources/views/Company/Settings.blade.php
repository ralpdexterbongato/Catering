@extends('layouts.layout')
@section('title')
  Company settings
@endsection
@section('content')
  <companysettings></companysettings>
@endsection
@section('javascripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
  <script src="/js/jquery.geocomplete.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var location = <?php print_r(json_encode($companylocation)) ?>;
      var currentlat = parseFloat(location[0].lat);
      var currentlng = parseFloat(location[0].lng);
      var map= new google.maps.Map(document.getElementById('map-update'),{
        center:{
          lat:10.10,
          lng:10.10
        },
        zoom:15
      });
      $("#geomap-update").geocomplete({
        map:map,
        markerOptions: {
          draggable: true
        }
      }).bind('geocode:result',function(e, result){
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        $('#LatUpdate').val(lat);
        $('#LngUpdate').val(lng);
      });

      var marker = $("#geomap-update").geocomplete("marker");
      google.maps.event.addListener(marker,'dragend',function(){
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        $('#LatUpdate').val(lat);
        $('#LngUpdate').val(lng);
      });
      var strLat = location[0].lat.toString();
      var strLng = location[0].lng.toString();
      var lat_lng = ""+strLat+","+strLng+"";
      $("#geomap-update").geocomplete("find",lat_lng);
    });
  </script>
@endsection
