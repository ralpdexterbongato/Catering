@extends('layouts.layout')
@section('title')
{{$companyData[0]->name}} company
@endsection
@section('content')
  <companyprofile :user="{{Auth::user()}}" :company="{{$companyData}}"></companyprofile>
@endsection
