@extends('default.master')

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/adminFieldsStyle.css') }}"/>
@stop

@section('title')
Administrar campos
@stop

@section('content')
<div class="row" style="margin: 0px; padding: 20px">
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
                    <td><a href="#">Adicionar</a></td>
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
</div>
@stop