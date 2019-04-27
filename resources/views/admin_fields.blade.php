@extends('default.master')

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/adminFieldsStyle.css') }}"/>
@stop

@section('title')
    Administração
@stop

@section('content')
<div class="row" style="margin: 0px;">
    <div class="col-md-3">
        <div class="fields">
            <table>
                <tr>
                    <th colspan="2">Tipos de serviço</th>
                </tr>
                <tr class="add">
                    <th><i class="fas fa-plus-circle"></i></td>
                    <td><a href="tipo-de-servico/add">Adicionar</a></td>
                </tr>
                <tr class="edit">
                    <th><i class="fas fa-pen-square"></i></td>
                    <td><a href="tipo-de-servico/lista">Editar</a></td>
                </tr>
                <tr class="remove">
                    <th><i class="fas fa-times-circle"></i></td>
                    <td><a href="tipo-de-servico/lista">Remover</a></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-3">
        <div class="fields">
            <table>
                <tr>
                    <th colspan="2">Polos</th>
                </tr>
                <tr class="add">
                    <th><i class="fas fa-plus-circle"></i></td>
                    <td><a href="polo/add">Adicionar</a></td>
                </tr>
                <tr class="edit">
                    <th><i class="fas fa-pen-square"></i></td>
                    <td><a href="polo/lista">Editar</a></td>
                </tr>
                <tr class="remove">
                    <th><i class="fas fa-times-circle"></i></td>
                    <td><a href="polo/lista">Remover</a></td>
                </tr>
            </table>
        </div>
    </div>
    @if(Auth::user()->user_type_id == 1)
        <div class="col-md-3">
            <div class="fields">
                <table>
                    <tr>
                        <th colspan="2">Empresas</th>
                    </tr>
                    <tr class="add">
                        <th><i class="fas fa-plus-circle"></i></td>
                        <td><a href="empresa/add">Adicionar</a></td>
                    </tr>
                    <tr class="edit">
                        <th><i class="fas fa-pen-square"></i></td>
                        <td><a href="empresa/lista">Editar</a></td>
                    </tr>
                    <tr class="remove">
                        <th><i class="fas fa-times-circle"></i></td>
                        <td><a href="empresa/lista">Remover</a></td>
                    </tr>
                </table>
            </div>
        </div>
    @endif
    <div class="col-md-3">
        <div class="fields">
            <table>
                <tr>
                    <th colspan="2">Solicitantes</th>
                </tr>
                <tr class="add">
                    <th><i class="fas fa-plus-circle"></i></td>
                    <td><a href="solicitante/add">Adicionar</a></td>
                </tr>
                <tr class="edit">
                    <th><i class="fas fa-pen-square"></i></td>
                    <td><a href="solicitante/lista">Editar</a></td>
                </tr>
                <tr class="remove">
                    <th><i class="fas fa-times-circle"></i></td>
                    <td><a href="solicitante/lista">Remover</a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-md-3">
        <div class="fields">
            <table>
                <tr>
                    <th colspan="2">Remessas</th>
                </tr>
                <tr class="add">
                    <th><i class="fas fa-plus-circle"></i></td>
                    <td><a href="adicionar">Adicionar</a></td>
                </tr>
                <tr class="edit">
                    <th><i class="fas fa-pen-square"></i></td>
                    <td><a href="remessa/lista">Editar</a></td>
                </tr>
                <tr class="remove">
                    <th><i class="fas fa-times-circle"></i></td>
                    <td><a href="remessa/lista">Remover</a></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-3">
        <div class="fields">
            <table>
                <tr>
                    <th colspan="2">Usuários</th>
                </tr>
                <tr class="add">
                    <th><i class="fas fa-plus-circle"></i></td>
                    <td><a href="usuarios/add">Adicionar</a></td>
                </tr>
                <tr class="edit">
                    <th><i class="fas fa-pen-square"></i></td>
                    <td><a href="usuarios/lista">Editar</a></td>
                </tr>
                <tr class="remove">
                    <th><i class="fas fa-times-circle"></i></td>
                    <td><a href="usuarios/lista">Remover</a></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-3">
        <div class="fields">
            <table>
                <tr>
                    <th colspan="2">Relatórios</th>
                </tr>
                <tr class="add">
                    <th><i class="fas fa-plus-circle"></i></td>
                    <td><a href="relatorios/add">Adicionar</a></td>
                </tr>
                <tr class="edit">
                    <th><i class="fas fa-pen-square"></i></td>
                    <td><a href="usuarios/lista">Editar</a></td>
                </tr>
                <tr class="remove">
                    <th><i class="fas fa-times-circle"></i></td>
                    <td><a href="usuarios/lista">Remover</a></td>
                </tr>
            </table>
        </div>
    </div>

</div>
@stop