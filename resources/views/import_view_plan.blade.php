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
                <input name="localPath" value="{!! $file['localPath'] !!}" hidden>
                <table>
                    <tr>
                        <th>Nome da remessa:</th>
                        <td colspan="2"><input type="text" name="name" class="form-control @if($errors->has('remessa')) is-invalid @endif " value="{!! $file['name'] !!}"></td>
                        <td colspan="3">
                            <input type="checkbox" value="true" name="headTitle" id="headTitle"  checked>
                            <label for="headTitle">Primeira linha contém o título da coluna</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Solicitante</th>
                        <td>Valor unico:</td>
                        <td>
                            <select id="applicant" name="applicant" class="form-control  @if($errors->has('solicitante')) is-invalid @endif" onchange="clean($('#colApplicant'))">
                                <option value="">-- Selecione --</option>
                                @foreach($applicants as $applicant)
                                    <option value="{!! $applicant->id !!}" @if(old('applicant') == $applicant->id) selected @endif >{!! $applicant->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colApplicant" name="colApplicant" class="form-control  @if($errors->has('colSol')) is-invalid @endif" onchange="clean($('#applicant'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colApplicant') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Data de recebimento</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="date" id="dateReceive" name="dateReceive" class="form-control  @if($errors->has('data')) is-invalid @endif" value="{!! old('dateReceive') !!}" onchange="clean($('#colDateReceive'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colDateReceive" name="colDateReceive" class="form-control  @if($errors->has('colData')) is-invalid @endif" onchange="clean($('#dateReceive'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colDateReceive') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Tipo de serviço</th>
                        <td>Valor unico:</td>
                        <td>
                            <select id="serviceType" name="serviceType" class="form-control  @if($errors->has('tipo')) is-invalid @endif" onchange="clean($('#colServiceType'))">
                                <option value="">-- Selecione --</option>
                                @foreach($serviceType as $type)
                                    <option value="{!! $type->id !!}" @if(old('serviceType') == $type->id) selected @endif>{!! $type->type !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colServiceType" name="colServiceType" class="form-control  @if($errors->has('colTipo')) is-invalid @endif" onchange="clean($('#serviceType'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colServiceType') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Descrição do serviço</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="text" id="serviceDescr" name="serviceDescr" value="{!! old('serviceDescr') !!}" class="form-control" onchange="clean($('#colServiceDescr'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colServiceDescr" name="colServiceDescr" class="form-control" onchange="clean($('#serviceDescr'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colServiceDescr') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Página guia</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="text" id="pgGuia" name="pgGuia" value="{!! old('pgGuia') !!}" class="form-control" onchange="clean($('#colPgGuia'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colPgGuia" name="colPgGuia" class="form-control" onchange="clean($('#pgGuia'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colPgGuia') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Polo</th>
                        <td>Valor unico:</td>
                        <td>
                            <select id="polo" name="polo" class="form-control  @if($errors->has('polo')) is-invalid @endif" onchange="clean($('#colPolo'))">
                                <option value="">-- Selecione --</option>
                                @foreach($polos as $polo)
                                    <option value="{!! $polo->id !!}"  @if(old('polo') == $polo->id) selected @endif >{!! $polo->polo !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colPolo" name="colPolo" class="form-control  @if($errors->has('colPolo')) is-invalid @endif" onchange="clean($('#polo'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colPolo') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th>Endereço</th>
                        <td>Valor unico:</td>
                        <td>
                            <input type="text" id="address" name="address" value="{!! old('address') !!}" class="form-control  @if($errors->has('endereco')) is-invalid @endif" onchange="clean($('#colAddress'))"/>
                        </td>
                        <td>ou referente a coluna</td>
                        <td>
                            <select id="colAddress" name="colAddress" class="form-control  @if($errors->has('colEndereco')) is-invalid @endif" onchange="clean($('#address'))">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colAddress') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>da planilha</td>
                    </tr>

                    <tr>
                        <th colspan="3">
                            <input type="checkbox" value="true" name="concat" id="concat" @if(old('concat') == "true") checked @endif>
                            <label for="concat">Nº e complemento já concantenado com o endereço</label>
                        </th>
                        <td class="@if(old('concat') == "true") hideClass @else showClassCell @endif labelN">Nº</td>
                        <td class="@if(old('concat') == "true") hideClass @else showClassCell @endif labelN">
                            <select id="colN" name="colN" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colN') == $title) selected @endif>{!! $title !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="@if(old('concat') == "true") hideClass @else showClassCell @endif labelN">da planilha</td>
                    </tr>

                    <tr id="rowCompl" class="@if(old('concat') == "true") hideClass @else showClassRow @endif">
                        <th colspan="3"></th>
                        <td>Complemento</td>
                        <td>
                            <select id="colCompl" name="colCompl" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($titles as $title)
                                    <option value="{!! $title !!}" @if(old('colCompl') == $title) selected @endif>{!! $title !!}</option>
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