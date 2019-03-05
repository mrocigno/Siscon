@extends('default.master')
@section('title')
Importar serviços
@stop

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
<script type="text/javascript" src="{{ URL::asset('public/js/importScript.js') }}"></script>
@stop

@section('content')
    
    <input type="button" class="btn btn-success btn-import" id="sltButton" value="Importar planilha">
    <form action="importar/planilha" method="POST" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="file" id="file" hidden>
    </form>
    
@stop