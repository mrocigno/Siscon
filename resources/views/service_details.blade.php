@extends('default.master')
@section('title')
    Detalhes do serviço
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/servicesStyle.css') }}"/>

@stop

@section('content')
    <div class="gap-center-form">
        <div class="row">
            <div class="col-md-4">
                <div class="center-form max-size">
                    <table class="max-size">
                        <tr>
                            <th>
                                Remessa:
                            </th>
                            <td colspan="3" style="height: 40px">
                                {!! $service->delivery !!}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Solicitante:
                            </th>
                            <td style="padding: 0;" colspan="3">
                                <table class="max-size">
                                    <tr>
                                        <td>
                                            <select name="applicant_id" class="form-control" style="width: 100%" readonly>
                                                <option value="">-- Selecione --</option>
                                                @foreach($applicants as $applicant)
                                                    <option value="{!! $applicant->id !!}" @if($service->applicant_id == $applicant->id) selected @endif>{!! $applicant->name !!}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <th class="elipsis">
                                            Polo:
                                        </th>
                                        <td>
                                            <select name="polo_id" class="form-control" style="width: 100%" readonly>
                                                <option value="">-- Selecione --</option>
                                                @foreach($polos as $polo)
                                                    <option value="{!! $polo->id !!}" @if($service->polo_id == $polo->id) selected @endif>{!! $polo->polo !!}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>
                               Identificador:
                            </th>
                            <td>
                                <input id="identifier" name="identifier" class="form-control" type="text" value="{!! $service->id !!}" readonly>
                            </td>
                            <th class="elipsis">
                                Data recebido:
                            </th>
                            <td>
                                <input id="date_received" name="date_received" class="form-control" type="text" value="{!! $service->date_received !!}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th class="elipsis">
                                Tipo de serviço:
                            </th>
                            <td colspan="3">
                                <select name="service_type_id" class="form-control" readonly>
                                    <option value="">-- Selecione --</option>
                                    @foreach($types as $type)
                                        <option value="{!! $type->id !!}" @if($service->service_type_id == $type->id) selected @endif>{!! $type->type !!}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="elipsis" style="vertical-align: top">
                                Descrição:
                            </th>
                            <td colspan="3">
                                <textarea id="identifier" name="identifier" class="form-control" readonly>{!! $service->service_description !!}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="button" class="btn btn-danger" onclick="window.history.go(-1);" style="float: left" value="Voltar">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="center-form max-size">
                    <table class="max-size">
                        <tr>
                            <th>
                                Endereço:
                            </th>
                            <td>
                                <input id="address" name="address" class="form-control" type="text" value="{!! $address->address !!}" readonly>
                            </td>
                            <th>
                                Nº
                            </th>
                            <td style="max-width: 80px">
                                <input id="n" name="n" class="form-control" type="text" value="{!! $service->n !!}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bairro:
                            </th>
                            <td colspan="3">
                                <input id="neighborhood" name="neighborhood" class="form-control" type="text" value="{!! $address->neighborhood !!}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Cidade:
                            </th>
                            <td colspan="3" style="padding: 0">
                                <table class="max-size">
                                    <tr>
                                        <td>
                                            <input id="city" name="city" class="form-control" type="text" value="{!! $address->city !!}" readonly>
                                        </td>
                                        <th>
                                            UF:
                                        </th>
                                        <td style="max-width: 50px">
                                            <input id="uf" name="uf" class="form-control" type="text" value="{!! $address->uf !!}" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Latitude:
                            </th>
                            <td>
                                <input type="text" class="form-control" name="lat" id="lat" value="{!! $service->lat !!}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Longitude:
                            </th>
                            <td>
                                <input type="text" class="form-control" name="lng" id="lng" value="{!! $service->lng !!}" readonly>
                            </td>
                            <th colspan="2">
                                <input type="button" style="width: 100%; font-weight: bold" value="Geolocalizar" class="btn btn-warning" onclick="getLatLng()">
                            </th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <a href="https://www.google.com.br/maps/place/{!! $service->lat !!},{!! $service->lng !!}">
                                    <img id="map_img" style="width: 100%; max-height: 413px;" src="https://maps.googleapis.com/maps/api/staticmap?zoom=16&amp;size=600x300&amp;maptype=roadmap&amp;markers=color:red%7Clabel:C%7C{!! $service->lat !!},{!! $service->lng !!}&amp;key=AIzaSyDhd1XSpoJ1YlosDmycLN4KfeL3LbvqXGE">
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="center-form max-size {!! $status['class'] !!}">
                    <table class="max-size">
                        <tr>
                            <th style="text-align: center;">
                                <span style=" font-size: 150px">{!! $status['icon'] !!}</span>
                                <br>
                                {!! $status['description'] !!}
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
