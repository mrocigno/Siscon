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
        <div class="center-form" style="margin-bottom: 20px">
            <form action="planilha/save" method="post">
                {{ csrf_field() }}
                <input name="localPath" value="{!! $file['localPath'] !!}">
                <table>
                    <tr>
                        <th>Nome da remessa:</th>
                        <td colspan="2"><input type="text" name="name" class="form-control" value="{!! $file['name'] !!}"></td>
                        <td colspan="3">
                            <input type="checkbox" value="true" name="headTitle" id="headTitle" checked>
                            <label for="headTitle">Primeira linha contém o título da coluna</label>
                        </td>
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
                            <input type="date" id="date_receive" name="date_receive" class="form-control" onchange="clean($('#colDate_receive'))"/>
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

                    <tr>
                        <th>Descrição do serviço</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="text" id="serviceDescr" name="serviceDescr" class="form-control" onchange="clean($('#colServiceDescr'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colServiceDescr" name="colServiceDescr" class="form-control" onchange="clean($('#serviceDescr'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Página guia</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="text" id="pgGuia" name="pgGuia" class="form-control" onchange="clean($('#colPgGuia'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colPgGuia" name="colPgGuia" class="form-control" onchange="clean($('#pgGuia'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Polo</th>
                        <td>Valor unico:</td>
                        <td>
                            <select id="polo" name="polo" class="form-control" onchange="clean($('#colPolo'))">
                                <option value="">-- Selecione --</option>
                                @foreach($polos as $polo)
                                    <option value="{!! $polo->id !!}">{!! $polo->polo !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colPolo" name="colPolo" class="form-control" onchange="clean($('#polo'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Endereço</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="text" id="address" name="address" class="form-control" onchange="clean($('#colAddress'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colAddress" name="colAddress" class="form-control" onchange="clean($('#address'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th colspan="3">
                            <input type="checkbox" value="true" name="concat" id="concat" checked>
                            <label for="concat">Nº e complemento já concantenado com o endereço</label>
                        </th>
                        <td class="hideClass labelN">Nº</td>
                        <td class="hideClass labelN">
                            <select id="colN" name="colN" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="hideClass labelN">da planilha</td>
                    </tr>

                    <tr id="rowCompl" class="hideClass">
                        <th colspan="3"></th>
                        <td>Complemento</td>
                        <td>
                            <select id="colCompl" name="colCompl" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}">{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <td colspan="5"></td>
                        <td>
                            <input type="submit" name="save" value="Prosseguir" class="btn btn-success">
                        </td>
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
                            <td class="elipsis">{!! $column !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop