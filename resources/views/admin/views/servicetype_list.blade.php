@extends('admin.default')
@section('title')
    Lista de tipos de serviço
@stop

@section('list')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
                    <th>Deletar/Editar</th><th>ID</th><th>Tipo</th><th>&nbsp;</th>
                </tr>
                @foreach($types as $type)
                    <tr>
                        <td class="center-text">
                            <a href="delete/{!! $type->id !!}"><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $type->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td>{!! $type->id !!}</td>
                        <td>{!! $type->type !!}</td>
                        <td style="width: 70%;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop