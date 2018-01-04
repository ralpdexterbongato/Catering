@extends('layouts.layout')
@section('title')
  Package Details
@endsection
@section('content')
  <packageshow :packageid="{{$package}}"></packageshow>
@endsection
