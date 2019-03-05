@extends('default.master')
@section('title')
Importar serviços
@stop

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
<script type="text/javascript" src="{{ URL::asset('public/js/importScript.js') }}"></script>
@stop

@section('content')
    
    <table>
        @foreach($rows as $row)
            <tr>
                @foreach($row as $key => $column)
                    <td>{!! $column !!}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
    
@stop