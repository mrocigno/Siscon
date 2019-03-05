@extends('admin.default')
@section('title')
    Lista de solicitantes
@stop

@section('list')
    <center style="padding: 20px;">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="head">
                    <th>Deletar/Editar</th><th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>&nbsp;</th>
                </tr>
                @foreach($applicants as $applicant)
                    <tr>
                        <td class="center-text">
                            <a href="delete/{!! $applicant->id !!}"><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $applicant->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td>{!! $applicant->id !!}</td>
                        <td>{!! $applicant->name !!}</td>
                        <td>{!! $applicant->email !!}</td>
                        <td>{!! $applicant->telefone !!}</td>
                        <td style="width: 50%;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </center>
@stop