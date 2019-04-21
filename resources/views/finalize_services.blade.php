@extends('default.master')
@section('title')
    Finalizar serviços
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/distributeStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/distributeScript.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/js/serviceScript.js') }}"></script>
@stop

@section('content')
    <input type="file" multiple id="hidden-input-file" hidden>
    <div class="gap-center-form">
        <div class="center-form max-size">
            <div id="table-content">

            </div>
            <input type="text" name="date" id="formDate" value="<?php $data = date_create(); echo date_format($data, 'Y-m-d'); ?>" hidden>
            <input type="text" name="userId" id="formUser" hidden>
        </div>
    </div>
@stop

@section('menuOptions')

    <table class="max-size" style="height: 100%;">
        <tr>
            <td style="height: 100%; vertical-align: top;">
                @include('default.filters_service', array('type' => 'toFinalize'))
            </td>
        </tr>
    </table>

    <script>
        showMenuOptions();
        getTable();

    </script>

@stop