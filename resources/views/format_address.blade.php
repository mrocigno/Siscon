@extends('default.master')
@section('title')
    Geolocalização
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/formatScript.js') }}"></script>
@stop

@section('content')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <form id="save-formated" action="{!! URL::to('geolocalizacao') !!}/save-formated" method="post">
                {{ csrf_field() }}
                <table id="table-format" class="table-list">
                    <tr class="table-head">
                        <th class="elipsis">
                            <input type="checkbox" class="check-input" id="check-all" onchange="selectAll(this)" checked>
                            <label for="check-all" class="check-white">
                                <svg width="15px" height="15px" viewBox="0 0 18 18">
                                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                    <polyline points="1 9 7 14 15 4"></polyline>
                                </svg>
                            </label>
                        </th>
                        <th>Endereço</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Endereço formatado</th>
                        <th>Rua de referência</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>CEP</th>
                    </tr>
                    @foreach($addresses as $address)
                        <tr data-id="{!! $address->sid !!}">
                            <td>
                                <input type="checkbox" value="{!! $address->sid !!}" id="check-{!! $address->sid !!}" class="check-input" name="ids[]" checked>
                                <label for="check-{!! $address->sid !!}" class="check">
                                    <svg width="15px" height="15px" viewBox="0 0 18 18">
                                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                        <polyline points="1 9 7 14 15 4"></polyline>
                                    </svg>
                                </label>
                            </td>
                            <td><input name="address_{!! $address->sid !!}" type="text" class="form-control format-address" value="{!! $address->address . ', ' . $address->n !!}" style="min-width: 300px;"></td>
                            <td><input name="lat_{!! $address->sid !!}" type="text" class="form-control format-lat" style="min-width: 100px;"></td>
                            <td><input name="lng_{!! $address->sid !!}" type="text" class="form-control format-lng" style="min-width: 100px;"></td>
                            <td><input name="faddress_{!! $address->sid !!}" type="text" class="form-control format-faddress" value="{!! $address->formatted_address !!}" style="min-width: 300px;"></td>
                            <td><input name="raddress_{!! $address->sid !!}" type="text" class="form-control format-raddress" value="{!! $address->reference_address !!}" style="min-width: 300px;"></td>
                            <td><input name="neighborhood_{!! $address->sid !!}" type="text" class="form-control format-neighborhood" value="{!! $address->neighborhood !!}" style="min-width: 150px;"></td>
                            <td><input name="city_{!! $address->sid !!}" type="text" class="form-control format-city" value="{!! $address->city !!}" style="min-width: 150px;"></td>
                            <td><input name="uf_{!! $address->sid !!}" type="text" class="form-control format-uf" value="{!! $address->uf !!}" style="min-width: 50px;"></td>
                            <td><input name="zipCode_{!! $address->sid !!}" type="text" class="form-control format-zipCode" value="{!! $address->zip_code !!}" style="min-width: 150px;"></td>
                        </tr>
                    @endforeach
                </table>
            </form>
        </div>
    </div>
@stop

@section('menuOptions')

    <table class="max-size" style="height: 100%">
        <tr>
            <th>
                Localizar selecionados:
            </th>
        </tr>
        <tr>
            <td>
                Localizar pelo endereço
            </td>
        </tr>
        <tr>
            <td>
                <center><input type="button" id="format-select-btn" value="Localizar" style="width: 100%;" class="btn"></center>
            </td>
        </tr>
        <tr>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                Localizar pela referência:
            </td>
        </tr>
        <tr>
            <td>
                <center><input type="button" id="format-select-btn" value="Localizar" style="width: 100%;" class="btn"></center>
            </td>
        </tr>
        <tr>
            <td style="height: 100%;"></td>
        </tr>
        <tr>
            <td>
                <input type="button" id="continue" value="Prosseguir sem salvar" onclick="submitYesNo('save-formated');" style="width: 100%" class="btn btn-danger">
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="continue" value="Salvar" onclick="submitYesNo('save-formated');" style="width: 100%" class="btn btn-success">
            </td>
        </tr>

    </table>

    <script>
        showMenuOptions();
    </script>

@stop