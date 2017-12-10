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
