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
        <form id="form" method="post" target="_blank" class="center-form max-size">
            {{ csrf_field() }}
            <div id="table-content">

            </div>
        </form>
    </div>
@stop

@section('menuOptions')

    <table class="max-size" style="height: 100%;">
        <tr>
            <td>
                <div id="box1">
                    <div class="item">
                        <span onclick="printServices()">
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-print"></i></td>
                                    <td>Imprimir</td>
                                </tr>
                            </table>
                        </span>
                    </div>
                    <div class="item">
                        <span onclick="generateMap()">
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-map-marked-alt"></i></td>
                                    <td>Gerar mapa</td>
                                </tr>
                            </table>
                        </span>
                    </div>
                    <div class="item">
                        <span onclick="exportXlsx()">
                            <table>
                                <tr>
                                    <td class="iconMenu"><i class="fas fa-file-excel"></i></td>
                                    <td>Exportar XLSX</td>
                                </tr>
                            </table>
                        </span>
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
    <div id="teste"></div>
    <script>
        showMenuOptions();
        getTable();
    </script>

@stop