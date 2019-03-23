@extends('admin.default')
@section('title')
    Lista de usuários
@stop

@section('list')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
                    <th class="elipsis">Deletar/Editar</th>
                    <th class="elipsis">ID</th>
                    <th class="elipsis">Nome</th>
                    <th class="elipsis">Email</th>
                    <th class="elipsis">Empresa</th>
                    <th class="elipsis">Tipo de usuário</th>
                    <th>&nbsp;</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td class="center-text elipsis">
                            <a href="delete/{!! $user->id !!}"><i class="fas fa-times-circle" style="color: red;"></i></a>&nbsp;&nbsp;
                            <a href="editar/{!! $user->id !!}"><i class="fas fa-pen-square" style="color: orange"></i></a>
                        </td>
                        <td class="elipsis">{!! $user->id !!}</td>
                        <td class="elipsis">{!! $user->name !!}</td>
                        <td class="elipsis">{!! $user->email !!}</td>
                        <td class="elipsis">{!! $user->company_name !!}</td>
                        <td class="elipsis">{!! $user->user_type !!}</td>
                        <td class="elipsis" style="width: 50%;"></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop