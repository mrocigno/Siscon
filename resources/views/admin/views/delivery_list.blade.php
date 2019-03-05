@extends('admin.default')
@section('title')
    Lista de remessas
@stop

@section('list')
    <center style="padding: 20px;">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="head">
                    <th>Deletar/Editar</th><th>ID</th><th>Remessa</th><th>Número de serviços</th><th>Adicionada em</th><th>&nbsp;</th>
                </tr>
                @foreach($deliveries as $delivery)
                    <tr>
                        <td class="center-text">
                            <a href=""><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $delivery->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td>{!! $delivery->id !!}</td>
                        <td>{!! $delivery->name !!}</td>
                        <td>{!! $delivery->num_services !!}</td>
                        <td>{!! $delivery->created_at !!}</td>
                        <td style="width: 30%;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </center>
@stop