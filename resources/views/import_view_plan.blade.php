@extends('default.master')
@section('title')
Importar serviços
@stop

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
<script type="text/javascript" src="{{ URL::asset('public/js/importScript.js') }}"></script>
@stop

@section('content')
    <div style="padding: 20px">

        <div class="center-form">
            <form>
                <table>
                    <tr>
                        <th>Nome da remessa:</th>
                        <td colspan="4"><input type="text" name="name" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Solicitante =</th>
                        <td>Valor unico:</td>
                        <td>
                            <select name="applicant" class="form-control" onchange="clean($('#colApplicant'))">
                                <option value="-1">-- Selecione --</option>
                                @foreach($applicants as $applicant)
                                    <option value="{!! $applicant->id !!}">{!! $applicant->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select  name="colApplicant" class="form-control" id="colApplicant">
                                <option value="-1">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="center-form max-size">
            <table class="table-list">
                <tr class="head">
                    @foreach($titles as $title)
                        <th>{!! $title !!}</th>
                    @endforeach
                </tr>
                @foreach($rows as $row)
                    <tr>
                        @foreach($row as $column)
                            <td>{!! $column !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop