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
