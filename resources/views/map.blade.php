{{--<html>--}}
{{--    <head>--}}
{{--        <title>Mapa</title>--}}
{{--        @include('default.head')--}}
{{--        <script src="{{ URL::asset('public/js/mapsScript.js') }}"></script>--}}
{{--        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhd1XSpoJ1YlosDmycLN4KfeL3LbvqXGE&callback=initMap" async defer></script>--}}
{{--    </head>--}}
{{--    <body>--}}
{{--        <div id="map_img" style="width: 100%; height: 100vh"></div>--}}
{{--        <div id="map_legend" class="center-form" style="position: fixed; display: block; top: 20px; left: 20px; padding: 0; width: 300px; max-height: 600px; overflow: auto">--}}

{{--        </div>--}}
{{--    </body>--}}
{{--    <script>--}}
{{--        let info;--}}
{{--        @foreach($coordinates as $coordinate)--}}
{{--            info =--}}
{{--            "<div>" +--}}
{{--            "   <div style='text-align: center; font-size: 17px'>{!! $coordinate->type !!}</div>" +--}}
{{--            "   <div style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;'>{!! $coordinate->service_description !!}</div><br>" +--}}
{{--            "   <b>{!! $coordinate->address . ", " . $coordinate->n !!}</b>" +--}}
{{--            "</div>";--}}

{{--            placeMarker({!! $coordinate->id !!}, "{!! $coordinate->lat !!}", "{!! $coordinate->lng !!}", info, {address: "{!! $coordinate->address . ", " . $coordinate->n !!}"});--}}
{{--        @endforeach--}}
{{--    </script>--}}
{{--</html>--}}

@extends('default.master')
@section('title')
    Mapa
@stop

@section('stylecustom')
    <script src="{{ URL::asset('public/js/mapsScript.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhd1XSpoJ1YlosDmycLN4KfeL3LbvqXGE&callback=initMap" async defer></script>
@stop

@section('drawer')
    <div id="map_legend">

    </div>
@stop

@section('content')
    <div id="map_img" style="width: 100%; height: calc(100vh - 60px)"></div>
    <script>
        let info;
        @foreach($coordinates as $coordinate)
            info =
            "<div>" +
            "   <div style='text-align: center; font-size: 17px'>{!! $coordinate->type !!}</div>" +
            "   <div style='white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;'>{!! $coordinate->service_description !!}</div><br>" +
            "   <b>{!! $coordinate->address . ", " . $coordinate->n !!}</b>" +
            "</div>";
            placeMarker({!! $coordinate->id !!}, "{!! $coordinate->lat !!}", "{!! $coordinate->lng !!}", info, {address: "{!! $coordinate->address . ", " . $coordinate->n !!}"});
        @endforeach
    </script>
@stop