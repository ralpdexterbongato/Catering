@extends('layouts.layout')
@section('title')
  Package Details
@endsection
@section('content')
  <packageshow :packageid="{{$package}}" :ownerid="{{$ownerid}}" :user="{{Auth::user()}}"></packageshow>
@endsection
