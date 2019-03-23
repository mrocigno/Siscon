@extends('admin.default')
@section('title')
    Lista de polos
@stop

@section('list')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
                    <th>Deletar/Editar</th><th>ID</th><th>Tipo</th><th>&nbsp;</th>
                </tr>
                @foreach($polos as $polo)
                    <tr>
                        <td class="center-text">
                            <a href="delete/{!! $polo->id !!}"><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $polo->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td>{!! $polo->id !!}</td>
                        <td>{!! $polo->polo !!}</td>
                        <td style="width: 70%;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop