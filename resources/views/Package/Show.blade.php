@extends('layouts.layout')
@section('title')
  Package Details
@endsection
@section('content')
  @if (Auth::check())
  <packageshow :packageid="{{$package}}" :ownerid="{{$ownerid}}" :user="{{Auth::user()}}"></packageshow>
  @else
  <packageshow :packageid="{{$package}}" :ownerid="{{$ownerid}}" ></packageshow>
  @endif
@endsection
