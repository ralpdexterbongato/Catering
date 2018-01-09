@extends('layouts.layout')
@section('title')
  New password reset
@endsection
@section('content')
  <passwordrecover :matchuser="{{$userMatched}}"></passwordrecover>
@endsection
