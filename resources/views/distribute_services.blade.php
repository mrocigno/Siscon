@extends('default.master')
@section('title')
    Distribuir serviços
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/distributeStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/distributeScript.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/js/serviceScript.js') }}"></script>
@stop

@section('content')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <form name="teste" id="create-route" action="distribuir/criar-rota" method="post">
                {{ csrf_field() }}
                <div id="table-content">
                    
                </div>
                <input type="text" name="date" id="date" value="<?php $data = date_create(); echo date_format($data, 'Y-m-d'); ?>" hidden>
                <input type="text" name="userId" id="userId" hidden>
            </form>
        </div>
    </div>
    <div class="info-card">
         serviços encontrados
    </div>
@stop

@section('menuOptions')

    <table class="max-size" style="height: 100%;">
        <tr>
            <td style="text-align: center">
                <span class="errors">
                    {{ $errors->first('usuário') }}
                    @if($errors->has('usuário'))<br/>@endif
                    {{ $errors->first('dia') }}
                    @if($errors->has('dia'))<br/>@endif
                    {{ $errors->first('serviço') }}
                    @if($errors->has('serviço'))<br/>@endif
                </span>
            </td>
        </tr>
        <tr>
            <th>
                Para:
            </th>
        </tr>
        <tr>
            <td>
                <select name="for" class="form-control" onchange="setValue($(this).val(), 'userId')">
                    <option value="">-- Selecione --</option>
                    @foreach($users as $user)
                        <option value="{!! $user->id !!}">{!! $user->name !!}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th>
                No dia:
            </th>
        </tr>
        <tr>
            <td>
                <input type="date" value="<?php $data = date_create(); echo date_format($data, 'Y-m-d'); ?>" class="form-control" onchange="setValue($(this).val(), 'date')">
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <input type="button" id="distribute-next" class="btn" onclick="submitYesNo('create-route')" value="Confirmar">
                </center>
            </td>
        </tr>
        <tr>
            <td style="height: 100%; vertical-align: top;">
                @include('default.filters_service', array('type' => 'toDistribute'))
            </td>
        </tr>
    </table>

    <script>
        showMenuOptions();
        getTable();
    </script>

@stop