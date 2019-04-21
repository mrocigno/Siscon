@extends('default.master')
@section('title')
    Detalhes do serviço
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/servicesStyle.css') }}"/>
    <script src="{{ URL::asset('public/js/detailsScript.js') }}"></script>
    <script src="{{ URL::asset('public/js/importScript.js') }}"></script>
    <script src="{{ URL::asset('public/js/formatScript.js') }}"></script>
@stop

@section('content')
    <div class="gap-center-form">
        <form class="row" action="update" id="update" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" id="return" name="return" value="{!! (old('return') != null? old('return') : URL::previous()) !!}">
            <input type="hidden" id="status_id" name="status_id" value="{!! (old('status_id') != null? old('status_id') : $status['id']) !!}">
            @if(isset($ds->id))
                <input type="hidden" id="dist_id" name="dist_id" value="{!! $ds->id !!}">
            @endif
            <div class="col-md-4">
                <div class="center-form max-size" style="padding: 10px">
                    <table class="max-size">
                        <tr>
                            <th>
                                Remessa:
                            </th>
                            <td colspan="3" style="height: 40px">
                                {!! $delivery->name !!}
                            </td>
                        </tr>
                        <tr>
                            <th style="width: 30px">
                                ID:
                            </th>
                            <td colspan="3">
                                <input id="id" name="id" type="text" class="form-control" value="{!! $service->id !!}"
                                       readonly>
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
                                            <select name="applicant_id" id="applicant_id"
                                                    class="form-control @if($errors->has('applicant_id')) is-invalid @endif"
                                                    style="width: 100%" readonly>
                                                <option value="">-- Selecione --</option>
                                                @foreach($applicants as $applicant)
                                                    <option value="{!! $applicant->id !!}"
                                                            @if((session()->get('editing')? old('applicant_id') : $service->applicant_id) == $applicant->id) selected @endif>{!! $applicant->name !!}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <th class="elipsis">
                                            Polo:
                                        </th>
                                        <td>
                                            <select name="polo_id" id="polo_id"
                                                    class="form-control  @if($errors->has('polo_id')) is-invalid @endif"
                                                    style="width: 100%" readonly>
                                                <option value="">-- Selecione --</option>
                                                @foreach($polos as $polo)
                                                    <option value="{!! $polo->id !!}"
                                                            @if((session()->get('editing')? old('polo_id') : $service->polo_id) == $polo->id) selected @endif>{!! $polo->polo !!}</option>
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
                            <td colspan="3">
                                <input id="identifier" name="identifier" class="form-control" type="text"
                                       value="{!! (session()->get('editing')? old('identifier') : $service->identifier) !!}"
                                       readonly>
                            </td>
                        </tr>
                        <tr>
                            <th class="elipsis">
                                Data recebido:
                            </th>
                            <td colspan="3">
                                <input id="date_received" name="date_received"
                                       class="form-control @if($errors->has('date_received')) is-invalid @endif"
                                       type="date"
                                       value="<?php $data = date_create((session()->get('editing') ? old('date_received') : $service->date_received)); echo date_format($data, 'Y-m-d'); ?>"
                                       readonly>
                            </td>
                        </tr>
                        <tr>
                            <th class="elipsis">
                                Tipo de serviço:
                            </th>
                            <td colspan="3">
                                <select name="service_type_id" id="service_type_id"
                                        class="form-control @if($errors->has('service_type_id')) is-invalid @endif"
                                        readonly>
                                    <option value="">-- Selecione --</option>
                                    @foreach($types as $type)
                                        <option value="{!! $type->id !!}"
                                                @if((session()->get('editing')? old('service_type_id') : $service->service_type_id) == $type->id) selected @endif>{!! $type->type !!}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th class="elipsis" style="vertical-align: top">
                                Descrição:
                            </th>
                            <td colspan="3">
                                <textarea id="service_description" name="service_description" class="form-control"
                                          readonly>{!!  (session()->get('editing')? old('service_description') : $service->service_description) !!}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="button" class="btn btn-primary" style="float: left; width: 100%"
                                               value="Voltar" id="back">
                                    </div>
                                    <div class="col-md-4">
                                        <input id="save" type="button" class="btn btn-success hideClass"
                                               onclick="submitYesNo('update')" style="float: left;  width: 100%"
                                               value="Salvar">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="button" class="btn btn-warning" style="float: right; width: 100%"
                                               value="Editar" id="edit">
                                    </div>
                                </div>

                            </td>
                        </tr>
                    </table>
                </div>

                <div class="center-form max-size" style="margin: 10px 0; padding: 10px">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="imprimir/{!! $service->id !!}" class="btn btn-secondary" style="color: white; width: 100%;"><i class="fas fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir</a>
                        </div>
                        <div class="col-md-6">
                            <a href="teste.com" class="btn btn-danger" style="color: white; width: 100%;"><i class="fas fa-times"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remover</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="center-form max-size {!! $status['class'] !!}" style="padding: 10px">
                    <table class="max-size">
                        <tr>
                            <th colspan="2" style="text-align: center;">
                                <span style=" font-size: 150px">{!! $status['icon'] !!}</span>
                                <br>
                                {!! $status['description'] !!}
                            </th>
                        </tr>
                        @if($ds != null)
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <th>
                                    @if($status['class'] == 'executed')
                                        Executado por:
                                    @else
                                        Programado para:
                                    @endif
                                </th>
                                <td>
                                    <select name="user_id" id="user_id"
                                            class="form-control @if($errors->has('user_id')) is-invalid @endif"
                                            readonly>
                                        <option value="">-- Selecione --</option>
                                        @foreach($users as $user)
                                            <option value="{!! $user->id !!}"
                                                    @if((session()->get('editing')? old('user_id') : $ds->user_id) == $user->id) selected @endif>{!! $user->name !!}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    No dia:
                                </th>
                                <td>
                                    <input name="distributed_date" id="distributed_date" class="form-control  @if($errors->has('distributed_date')) is-invalid @endif"
                                           value="<?php $data = date_create((session()->get('editing') ? old('distributed_date') : $ds->distributed_date)); echo date_format($data, 'Y-m-d'); ?>"
                                           type="date" readonly>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>

                @if($fs != null)
                    <div class="center-form max-size {!! $status['class'] !!}" style="padding: 10px; margin-top: 10px">
                        <table class="max-size">
                            <tr>
                                <th>
                                    Observações:
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="observation" class="form-control" readonly>{{ ($fs->observation == null? "Sem observações" : $fs->observation) }}</textarea>
                                </td>
                            </tr>
                            @if($photos->count() > 0)
                                <tr>
                                    <th style="vertical-align: top">
                                        Fotos:
                                    </th>
                                </tr>
                                @foreach($photos as $photo)
                                    <tr>
                                        <td>
                                            <img style="border: 1px solid black" src="{!! $photo->link !!}" width="100%">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                @endif

            </div>
            <div class="col-md-4">
                <div class="center-form max-size" style="padding: 10px">
                    <table class="max-size">
                        <tr>
                            <th>
                                Endereço:
                            </th>
                            <td>
                                <input id="address" name="address"
                                       class="form-control @if($errors->has('address')) is-invalid @endif"
                                       type="text"
                                       value="{!! (session()->get('editing')? old('address') : $address->address)  !!}"
                                       readonly>
                                <input id="addressEdt" name="addressEdt" type="hidden"
                                       value="{!! old('addressEdt') !!}">
                            </td>
                            <th>
                                Nº
                            </th>
                            <td style="max-width: 80px">
                                <input id="n" name="n" class="form-control @if($errors->has('n')) is-invalid @endif"
                                       type="text" value="{!! (session()->get('editing')? old('n') : $service->n)  !!}"
                                       readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Bairro:
                            </th>
                            <td colspan="3">
                                <input id="neighborhood" name="neighborhood" class="form-control" type="text"
                                       value="{!! (session()->get('editing')? old('neighborhood') : $address->neighborhood)  !!}"
                                       readonly>
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
                                            <input id="city" name="city"
                                                   class="form-control @if($errors->has('city')) is-invalid @endif"
                                                   type="text"
                                                   value="{!! (session()->get('editing')? old('city') : $address->city)  !!}"
                                                   readonly>
                                        </td>
                                        <th>
                                            UF:
                                        </th>
                                        <td style="width: 70px;">
                                            <input id="uf" name="uf"
                                                   class="form-control @if($errors->has('uf')) is-invalid @endif"
                                                   type="text"
                                                   value="{!! (session()->get('editing')? old('uf') : $address->uf)  !!}"
                                                   readonly>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Latitude:
                            </th>
                            <td colspan="3">
                                <input type="text" class="form-control @if($errors->has('lat')) is-invalid @endif"
                                       name="lat" id="lat"
                                       value="{!! (session()->get('editing')? old('lat') : $service->lat)  !!}"
                                       readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Longitude:
                            </th>
                            <td>
                                <input type="text" class="form-control @if($errors->has('lng')) is-invalid @endif"
                                       name="lng" id="lng"
                                       value="{!! (session()->get('editing')? old('lng') : $service->lng)  !!}"
                                       readonly>
                            </td>
                            <th colspan="2">
                                <input type="button" style="width: 100%; font-weight: bold" value="Geolocalizar"
                                       class="btn btn-warning" onclick="addLatLng({!! $service->id !!})">
                            </th>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <a href="https://www.google.com.br/maps/place/{!! $service->lat !!},{!! $service->lng !!}">
                                    <img id="map_img"
                                         style="width: calc(100% + 30px); margin: 5px -15px -15px -15px; border-top: 1px solid lightgray;"
                                         src="https://maps.googleapis.com/maps/api/staticmap?zoom=16&size=600x300&maptype=roadmap&markers=color:red%7Clabel:C%7C{!! $service->lat !!},{!! $service->lng !!}&key=AIzaSyDhd1XSpoJ1YlosDmycLN4KfeL3LbvqXGE">
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    </div>
    @if(session()->get('message'))
        <script>
            customAlert("{!! session()->get('message') !!}");
        </script>
    @endif
    @if(session()->get('editing'))
        <script>
            $(document).ready(function () {
                $("#edit").click();
            });
        </script>
    @endif
@stop
