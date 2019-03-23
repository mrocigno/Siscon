@extends('default.master')
@section('title')
    Serviços
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/servicesStyle.css') }}"/>
{{--    <script type="text/javascript" src="{{ URL::asset('public/js/formatScript.js') }}"></script>--}}
    <script type="text/javascript" src="{{ URL::asset('public/js/serviceScript.js') }}"></script>
@stop

@section('content')
    <div class="gap-center-form">
        <div class="center-form max-size">
            {{ csrf_field() }}
            <div id="table-content">

            </div>
        </div>
    </div>
@stop

@section('menuOptions')

    <table class="max-size" style="height: 100%;">
        <tr>
            <td>
                <div id="box1">
                    <div class="item">
                        <a href='{{ URL::to('/') }}/importar'>
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-file-excel"></i></td>
                                    <td>Importar</td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="item">
                        <a href="{{ URL::to('/') }}/distribuir">
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-share"></i></td>
                                    <td>Distribuir</td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="item">
                        <a href='{{ URL::to('/') }}/finalizar'>
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-exchange-alt"></i></td>
                                    <td>Finalizar</td>
                                </tr>
                            </table>
                        </a>
                    </div>

                    <div class="item">
                        <a href='{{ URL::to('/servicos/') }}/geolocalizar'>
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-map-marker-alt"></i></td>
                                    <td>Geolocalizar</td>
                                </tr>
                            </table>
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="height: 100%; vertical-align: top;">
                @include('default.filters_service', array('type' => 'showAll'))
            </td>
        </tr>
    </table>

    <script>
        showMenuOptions();
        getTable();
    </script>

@stop