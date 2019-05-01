@extends('default.master')
@section('title')
    @yield('title')
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/adminFieldsStyle.css') }}"/>
    @yield('header_custom')
@stop

@section('content')
    @yield('add')
    @yield('list')
    @yield('edit')
@stop