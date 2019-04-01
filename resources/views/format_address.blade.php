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
                            </td>
                            <td><input type="text" class="form-control format-address" value="{!! $address->address . ', ' . $address->n !!}" style="min-width: 300px;"></td>
                            <td><input type="text" class="form-control format-lat" style="min-width: 100px;"></td>
                            <td><input type="text" class="form-control format-lng" style="min-width: 100px;"></td>
                            <td><input type="text" class="form-control format-faddress" value="{!! $address->formatted_address !!}" style="min-width: 300px;"></td>
                            <td><input type="text" class="form-control format-raddress" value="{!! $address->reference_address !!}" style="min-width: 300px;"></td>
                            <td><input type="text" class="form-control format-neighborhood" value="{!! $address->neighborhood !!}" style="min-width: 150px;"></td>
                            <td><input type="text" class="form-control format-city" value="{!! $address->city !!}" style="min-width: 150px;"></td>
                            <td><input type="text" class="form-control format-uf" value="{!! $address->uf !!}" style="min-width: 50px;"></td>
                            <td><input type="text" class="form-control format-zipCode" value="{!! $address->zip_code !!}" style="min-width: 150px;"></td>
                            <td class="hideClass"><input name="values_{!! $address->sid !!}" class="formatted-values"></td>
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
            <td>
                Localizar pelo endereço
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="format-select-btn" value="Localizar" style="width: 100%;" class="btn btn-secondary">
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
                <input type="button" id="format-select-btn" value="Localizar" style="width: 100%;" class="btn btn-secondary">
            </td>
        </tr>
        <tr>
            <td style="height: 100%;"></td>
        </tr>
        <tr>
            <td>
                {{--<input type="button" id="continue" value="Prosseguir sem salvar" onclick="submitYesNo('save-formated');" style="width: 100%" class="btn btn-danger">--}}
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" id="continue" value="Salvar" onclick="confirmSubmit();" style="width: 100%;" class="btn btn-success">
            </td>
        </tr>

    </table>

    <script>
        showMenuOptions();
    </script>

@stop