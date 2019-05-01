@extends('admin.default')
@section('title')
    Lista de relatórios
@stop

@section('list')
    <div class="gap-center-form">
        @if(session()->has('error'))
            <span class="errors">{!! session()->get('error') !!}</span>
        @endif
        @if(session()->has('success'))
            <span class="success">{!! session()->get('success') !!}</span>
        @endif
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
                    <th>Deletar/Editar</th><th>ID</th><th>Tipo de serviço</th><th>Criado em</th><th>&nbsp;</th>
                </tr>
                @foreach($reports as $report)
                    <tr>
                        <td class="center-text">
                            <a href="delete/{!! $report->id !!}"><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $report->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td>{!! $report->id !!}</td>
                        <td>{!! $report->service_type !!}</td>
                        <td>{!! $report->created_at !!}</td>
                        <td style="width: 50%;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop