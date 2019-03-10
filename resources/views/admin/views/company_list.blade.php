@extends('admin.default')
@section('title')
    Lista de empresas
@stop

@section('list')
    <center style="padding: 20px;">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
                    <th>Deletar/Editar</th><th>ID</th><th>Nome</th><th>Logo</th>
                </tr>
                @foreach($companies as $company)
                    <tr>
                        <td class="center-text">
                            <a href="delete/{!! $company->id !!}"><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $company->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td>{!! $company->id !!}</td>
                        <td>{!! $company->name !!}</td>
                        <td>{!! $company->logo !!}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </center>
@stop