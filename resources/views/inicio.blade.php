@extends('default.master')
@section('title')
Inicio
@stop

@section('content')
    
    <div class="gap-center-form">
            <div style="width: 600px; margin: 10px auto">
                @include('default.assets.logo')
            </div>

        <div class="row">
            <div class="col-md-6">
                <div style="padding: 10px;" id="user-prod">

                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </div>

    <script>

        $.ajax({
            url: 'inicio/user-prod/5/2019',
            type: 'get',
            success: (data) =>{
                $("#user-prod").html(data);
            }
        });

    </script>

@stop