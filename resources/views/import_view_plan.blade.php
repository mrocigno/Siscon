@extends('default.master')
@section('title')
Importar serviços
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/importScript.js') }}"></script>
@stop

@section('content')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <table class="table-list">
                <tr class="table-head">
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

@section('menuOptions')

    <form id="form" action="planilha/save" method="post">
        {{ csrf_field() }}
        <input name="localPath" value="{!! $file['localPath'] !!}" hidden>
        <table id="table-refer-fields">
            <tr>
                <th>Nome da remessa:</th>
            </tr>
            <tr>
                <td><input type="text" name="name" class="form-control @if($errors->has('remessa')) is-invalid @endif " value="{!! $file['name'] !!}"></td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Solicitante</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <select id="applicant" name="applicant" class="form-control  @if($errors->has('solicitante')) is-invalid @endif" onchange="clean($('#colApplicant'))">
                        <option value="">-- Selecione --</option>
                        @foreach($applicants as $applicant)
                            <option value="{!! $applicant->id !!}" @if(old('applicant') == $applicant->id) selected @endif >{!! $applicant->name !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colApplicant" name="colApplicant" class="form-control  @if($errors->has('colSol')) is-invalid @endif" onchange="clean($('#applicant'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colApplicant') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Identificador</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="identifier" name="identifier" value="{!! old('identifier') !!}" class="form-control" onchange="clean($('#colIdentifier'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colIdentifier" name="colIdentifier" class="form-control" onchange="clean($('#identifier'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colIdentifier') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Data de recebimento</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="date" id="dateReceive" name="dateReceive" class="form-control  @if($errors->has('data')) is-invalid @endif" value="{!! old('dateReceive') !!}" onchange="clean($('#colDateReceive'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colDateReceive" name="colDateReceive" class="form-control  @if($errors->has('colData')) is-invalid @endif" onchange="clean($('#dateReceive'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colDateReceive') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Tipo de serviço</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <select id="serviceType" name="serviceType" class="form-control  @if($errors->has('tipo')) is-invalid @endif" onchange="clean($('#colServiceType'))">
                        <option value="">-- Selecione --</option>
                        @foreach($serviceType as $type)
                            <option value="{!! $type->id !!}" @if(old('serviceType') == $type->id) selected @endif>{!! $type->type !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colServiceType" name="colServiceType" class="form-control  @if($errors->has('colTipo')) is-invalid @endif" onchange="clean($('#serviceType'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colServiceType') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Descrição do serviço</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="serviceDescr" name="serviceDescr" value="{!! old('serviceDescr') !!}" class="form-control" onchange="clean($('#colServiceDescr'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colServiceDescr" name="colServiceDescr" class="form-control" onchange="clean($('#serviceDescr'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colServiceDescr') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Página guia</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="pgGuia" name="pgGuia" value="{!! old('pgGuia') !!}" class="form-control" onchange="clean($('#colPgGuia'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colPgGuia" name="colPgGuia" class="form-control" onchange="clean($('#pgGuia'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colPgGuia') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Polo</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <select id="polo" name="polo" class="form-control  @if($errors->has('polo')) is-invalid @endif" onchange="clean($('#colPolo'))">
                        <option value="">-- Selecione --</option>
                        @foreach($polos as $polo)
                            <option value="{!! $polo->id !!}"  @if(old('polo') == $polo->id) selected @endif >{!! $polo->polo !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colPolo" name="colPolo" class="form-control  @if($errors->has('colPolo')) is-invalid @endif" onchange="clean($('#polo'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colPolo') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Endereço</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="address" name="address" value="{!! old('address') !!}" class="form-control  @if($errors->has('endereco')) is-invalid @endif" onchange="clean($('#colAddress'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colAddress" name="colAddress" class="form-control  @if($errors->has('colEndereco')) is-invalid @endif" onchange="clean($('#address'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colAddress') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <table style="width: 100%;">
                        <tr>
                            <td style="vertical-align: top"><input type="checkbox" value="true" name="concat" id="concat" @if(old('concat') == "true") checked @endif></td>
                            <th><label for="concat">Nº e complemento já concantenado com o endereço</label></th>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="@if(old('concat') == "true") hideClass @else showClassCell @endif labelN">
                    <table style="width: 100%;">
                        <tr>
                            <th>Nº</th>
                            <td>
                                <select id="colN" name="colN" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    @foreach($titles as $title)
                                        <option value="{!! $title !!}" @if(old('colN') == $title) selected @endif>{!! $title !!}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr id="rowCompl" class="@if(old('concat') == "true") hideClass @else showClassRow @endif">
                <td>
                    <table style="width: 100%;">
                        <tr>
                            <th>Compl.</th>
                            <td>
                                <select id="colCompl" name="colCompl" class="form-control">
                                    <option value="">-- Selecione --</option>
                                    @foreach($titles as $title)
                                        <option value="{!! $title !!}" @if(old('colCompl') == $title) selected @endif>{!! $title !!}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>Cidade</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="city" name="city" value="{!! old('city') !!}" class="form-control  @if($errors->has('cidade')) is-invalid @endif" onchange="clean($('#colCity'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colCity" name="colCity" class="form-control  @if($errors->has('colCidade')) is-invalid @endif" onchange="clean($('#city'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colCity') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th>
                    --- // ---
                </th>
            </tr>

            <tr>
                <th>UF</th>
            </tr>
            <tr>
                <td>Valor unico:</td>
            </tr>
            <tr>
                <td>
                    <input type="text" id="uf" name="uf" value="{!! old('uf') !!}" class="form-control  @if($errors->has('uf')) is-invalid @endif" onchange="clean($('#colUf'))"/>
                </td>
            </tr>
            <tr>
                <td>ou referente a coluna</td>
            </tr>
            <tr>
                <td>
                    <select id="colUf" name="colUf" class="form-control  @if($errors->has('colUf')) is-invalid @endif" onchange="clean($('#uf'))">
                        <option value="">-- Selecione --</option>
                        @foreach($titles as $title)
                            <option value="{!! $title !!}" @if(old('colUf') == $title) selected @endif>{!! $title !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="gap">
                <th></th>
            </tr>

            <tr>
                <td>
                    <center>
                        <input type="button" onclick="submitYesNo('form')" name="save" value="Prosseguir" class="btn btn-success">
                    </center>
                </td>
            </tr>

            <tr class="gap">
                <th></th>
            </tr>

        </table>
    </form>


    <script>
        showMenuOptions();
    </script>

@stop