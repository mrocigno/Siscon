@extends('default.master')
@section('title')
    Geo localização
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/formatScript.js') }}"></script>
@stop

@section('content')
    <div class="gap-center-form">
        <div class="center-form max-size">
            <form id="save-formated" action="../save-formated" method="post">
                {{ csrf_field() }}

                <input type="hidden" value="{{ $idRemessa }}" name="idRemessa">
                <input type="button" id="continue" value="Salvar" onclick="submitYesNo('save-formated');" class="btn btn-success" style="position: fixed; right: 5px; bottom: 5px;  z-index: 10;">
                <table id="table-format" class="table-list">
                    <tr class="table-head">
                        <th class="elipsis">&nbsp;&nbsp;&nbsp;<input id="all" type="checkbox">&nbsp;&nbsp;&nbsp; </th>
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
                            <td><input type="checkbox" value="{!! $address->sid !!}" checked class="format-check"></td>
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

    <table class="max-size">

        <tr>
            <td>
                <input type="button" id="format-select-btn" value="Formatar selecionados" class="btn btn-warning" style="width: 100%">
            </td>
        </tr>


    </table>

    <script>
        showMenuOptions();
    </script>

@stop