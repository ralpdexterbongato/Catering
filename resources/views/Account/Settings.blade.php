@extends('layouts.layout')
@section('title')
  Account settings
@endsection
@section('content')
<accountsettings :user="{{Auth::user()}}">
</accountsettings>
@endsection
