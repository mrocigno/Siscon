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
                        <th>Solicitante</th>
                        <td>Valor unico:</td>
                        <td>
                            <select id="applicant" name="applicant" class="form-control" onchange="clean($('#colApplicant'))">
                                <option value="">-- Selecione --</option>
                                @foreach($applicants as $applicant)
                                    <option value="{!! $applicant->id !!}">{!! $applicant->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colApplicant" name="colApplicant" class="form-control" onchange="clean($('#applicant'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Data de recebimento</th>
                        <td>Valor unico:</td>
                        <td>
                            <input id="date_receive" name="date_receive" class="form-control" onchange="clean($('#colDate_receive'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colDate_receive" name="colDate_receive" class="form-control" onchange="clean($('#date_receive'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Tipo de serviço</th>
                        <td>Valor unico:</td>
                        <td>
                            <select id="serviceType" name="serviceType" class="form-control" onchange="clean($('#colServiceType'))">
                                <option value="">-- Selecione --</option>
                                @foreach($serviceType as $type)
                                    <option value="{!! $type->id !!}">{!! $type->type !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colServiceType" name="colServiceType" class="form-control" onchange="clean($('#serviceType'))">
                                <option value="">-- Selecione --</option>
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