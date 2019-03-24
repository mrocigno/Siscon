@extends('default.master')
@section('title')
    Adicionar serviços
@stop

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
<script type="text/javascript" src="{{ URL::asset('public/js/importScript.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/formatScript.js') }}"></script>
@stop

@section('content')
    <form action="adicionar" method="POST" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="file" id="file" hidden>
    </form>
    <div class="gap-center-form">
        <div class="center-form" style="margin: 0 auto;">
            <input type="button" class="btn btn-secondary btn-import" id="sltButton" value="Importar planilha">
            <form action="{!! URL::to('adicionar/salvar-manual') !!}" method="post">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <td colspan="4">
                            <center><span class="errors" style="text-align: center">{!! session()->get('xlsxMessage') !!}</span></center>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" style="text-align: center; padding: 10px 0;">
                            ------------ Adicionar manualmente ------------
                        </th>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <center>
                                <span class="success" style="text-align: center">{!! session()->get('message') !!}</span>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Identificador:
                        </th>
                        <td colspan="3">
                            <input type="text" class="form-control" name="identifier" value="{!! old('identifier') !!}" autofocus>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Data recebido:
                        </th>
                        <td>
                            <input type="date" class="form-control @if($errors->has('data'))is-invalid @endif" name="date_received" value="{!! old('date_received') !!}">
                        </td>
                        <th style="text-align: end">
                            Tipo de serviço:
                        </th>
                        <td>
                            <select name="service_type" class="form-control @if($errors->has('tipo'))is-invalid @endif">
                                <option value="">-- Selecione --</option>
                                @foreach($serviceTypes as $type)
                                    <option value="{!! $type->id !!}" @if(old('service_type') == $type->id) selected @endif>{!! $type->type !!}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Endereço:
                        </th>
                        <td colspan="3">
                            <table class="table-without-padding max-size">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control @if($errors->has('endereco'))is-invalid @endif" name="address" id="address" value="{!! old('address') !!}">
                                    </td>
                                    <th style="padding-left: 10px">
                                        Nº:
                                    </th>
                                    <td style="width: 100px">
                                        <input type="text" class="form-control @if($errors->has('n'))is-invalid @endif" name="n" id="n" value="{!! old('n') !!}">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Bairro:
                        </th>
                        <td>
                            <input type="text" class="form-control" name="neighborhood" id="neighborhood" value="{!! old('neighborhood') !!}">
                        </td>
                        <th style="text-align: end">
                            Cidade:
                        </th>
                        <td>
                            <input type="text" class="form-control @if($errors->has('cidade'))is-invalid @endif" name="city" id="city" value="{!! old('city') !!}">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            UF:
                        </th>
                        <td>
                            <input type="text" class="form-control @if($errors->has('uf'))is-invalid @endif" name="uf" id="uf" value="{!! old('uf') !!}" maxlength="2">
                        </td>
                        <th style="text-align: end">
                            CEP:
                        </th>
                        <td>
                            <input type="text" class="form-control @if($errors->has('cep'))is-invalid @endif" name="zip_code" id="zip_code" value="{!! old('zip_code') !!}">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Latitude:
                        </th>
                        <td colspan="3">
                            <table class="table-without-padding max-size">
                                <tr>
                                    <td style="width: 150px">
                                        <input type="text" class="form-control @if($errors->has('latitude'))is-invalid @endif" name="lat" id="lat" value="{!! old('lat') !!}">
                                    </td>
                                    <th style="padding: 0 10px">
                                        Longitude:
                                    </th>
                                    <td style="width: 150px">
                                        <input type="text" class="form-control @if($errors->has('longitude'))is-invalid @endif" name="lng" id="lng" value="{!! old('lng') !!}">
                                    </td>
                                    <th style="padding-left: 10px">
                                        <input type="button" style="width: 100%; font-weight: bold" value="Geolocalizar" class="btn btn-warning" onclick="getLatLng()">
                                    </th>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Solicitante:
                        </th>
                        <td>
                            <select name="applicant" class="form-control @if($errors->has('solicitante'))is-invalid @endif">
                                <option value="">-- Selecione --</option>
                                @foreach($applicants as $applicant)
                                    <option value="{!! $applicant->id !!}" @if(old('applicant') == $applicant->id) selected @endif>{!! $applicant->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                        <th style="text-align: end">
                            Polo:
                        </th>
                        <td>
                            <select name="polo" class="form-control @if($errors->has('polo'))is-invalid @endif">
                                <option value="">-- Selecione --</option>
                                @foreach($polos as $polo)
                                    <option value="{!! $polo->id !!}" @if(old('polo') == $polo->id) selected @endif>{!! $polo->polo !!}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th style="vertical-align: top">
                            Descrição:
                        </th>
                        <td colspan="3">
                            <textarea class="form-control" name="description">{!! old('description') !!}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="submit" class="btn btn-success btn-import" value="Salvar" onclick="showLoading()">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
@stop