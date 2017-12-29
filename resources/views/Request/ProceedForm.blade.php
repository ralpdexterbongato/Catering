@extends('layouts.layout')
@section('title')
  Request form
@endsection
@section('content')
  <proceed :customfoods="{{$customFoods}}" :colors="{{$colorChoices}}" :company="{{$company}}"></proceed>
@endsection
@section('javascripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
  <script src="/js/jquery.geocomplete.min.js" type="text/javascript"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      today: 'Today',
      clear: 'Clear',
      close: 'Ok',
      format: 'mm/dd/yyyy',
      closeOnSelect: false // Close upon selecting a date,
      });

      $('.timepicker').pickatime({
        default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        twelvehour: true, // Use AM/PM or 24-hour format
        donetext: 'OK', // text for done-button
        cleartext: 'Clear', // text for clear-button
        canceltext: 'Cancel', // Text for cancel-button
        autoclose: false, // automatic close timepicker
        ampmclickable: true, // make AM PM clickable
        aftershow: function(){} //Function for after opening timepicker
      });
      var location = <?php print_r(json_encode($location)) ?>;
        $(document).ready(function() {
          var mymap = new GMaps({
             el: '#customer-location',
             lat: location[0].lat,
             lng: location[0].lng,
             zoom:15
           });
           $('#addressHeldLat').val(location[0].lat);
           $('#addressHeldLng').val(location[0].lng);

         var marker = mymap.addMarker({
            lat: location[0].lat,
            lng: location[0].lng,
            title: 'will be held',
            draggable:true
          });
          google.maps.event.addListener(marker,'dragend',function(){
            console.log(marker.getPosition().lat());
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            $('#addressHeldLat').val(lat);
            $('#addressHeldLng').val(lng);
          });
       });
    });
  </script>
@endsection
