@extends('default.master')

@section('stylecustom')

@stop

@section('title')
    Administrar campos
@stop

@section('content')
    <div class="master-content">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
                    <th class="elipsis">Deletar/Editar</th>
                    <th class="elipsis">Identificador</th>
                    <th class="elipsis">Data recebido</th>
                    <th class="elipsis">Tipo</th>
                    <th class="elipsis">Endereço</th>
                    <th class="elipsis">Descrição do serviço</th>
                    <th class="elipsis">Página guia</th>
                    <th class="elipsis">Solicitante</th>
                    <th class="elipsis">Polo</th>
                </tr>
                @foreach($services as $service)
                    <tr>
                        <td class="center-text">
                            <a href=""><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/0"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td class="elipsis">{!! $service->identifier !!}</td>
                        <td class="elipsis">{!! $service->date_received !!}</td>
                        <td class="elipsis">{!! $service->type !!}</td>
                        <td class="elipsis">{!! $service->address !!}</td>
                        <td class="elipsis">{!! $service->service_description !!}</td>
                        <td class="elipsis">{!! $service->pg_guia !!}</td>
                        <td class="elipsis">{!! $service->name !!}</td>
                        <td class="elipsis">{!! $service->polo !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop