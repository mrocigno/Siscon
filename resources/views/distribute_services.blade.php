@extends('default.master')
@section('title')
    Distribuir serviços
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/distributeStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/distributeScript.js') }}"></script>
@stop

@section('content')
    <div style="padding: 20px">
        <div class="center-form max-size">
            <form name="teste" id="create-route" action="distribuir/criar-rota" method="post">
                {{ csrf_field() }}
                <table class="table-list">
                    <tr class="table-head">
                        <th class="elipsis"><input type="checkbox"></th>
                        <th class="elipsis">Identificador</th>
                        <th class="elipsis">Data recebido</th>
                        <th class="elipsis">Tipo</th>
                        <th class="elipsis">Endereço</th>
                        <th class="elipsis">Latitude</th>
                        <th class="elipsis">Longitude</th>
                        <th class="elipsis">Descrição do serviço</th>
                        <th class="elipsis">Página guia</th>
                        <th class="elipsis">Solicitante</th>
                        <th class="elipsis">Polo</th>
                    </tr>
                    @foreach($services as $service)
                        <tr class="
                            @if($service->lat != 0 && is_null($service->status_id))
                                ready
                            @elseif($service->lat == 0 && is_null($service->status_id))
                                not-ready
                            @elseif(!is_null($service->status_id))
                                return
                            @endif">
                            <td class="center-text"><input type="checkbox" value="{!! $service->sid !!}" name="ids[]"></td>
                            <td class="elipsis">{!! $service->identifier !!}</td>
                            <td class="elipsis">{!! $service->date_received !!}</td>
                            <td class="elipsis">{!! $service->type !!}</td>
                            <td class="elipsis">{!! $service->address . ', ' . $service->n !!}</td>
                            <td class="elipsis">{!! $service->lat !!}</td>
                            <td class="elipsis">{!! $service->lng !!}</td>
                            <td class="elipsis">{!! $service->service_description !!}</td>
                            <td class="elipsis">{!! $service->pg_guia !!}</td>
                            <td class="elipsis">{!! $service->name !!}</td>
                            <td class="elipsis">{!! $service->polo !!}</td>
                        </tr>
                    @endforeach
                </table>
                <input type="text" name="date" id="date" value="<?php $data = date_create(); echo date_format($data, 'Y-m-d'); ?>" hidden>
                <input type="text" name="userId" id="userId" hidden>
            </form>
        </div>
    </div>
    <div class="info-card">
        {!! $count !!} serviços encontrados
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
                    <input type="button" id="distribute-next" class="btn btn-success" onclick="submitYesNo('create-route')" value="Confirmar">
                </center>
            </td>
        </tr>
        <tr>
            <td style="height: 100%">
                Filters here
            </td>
        </tr>
    </table>

    <script>
        showMenuOptions();
    </script>

@stop