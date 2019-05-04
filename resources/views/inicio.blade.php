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
            <div class="col-md-6" style="padding: 10px 20px">
                <div class="center-form max-size">
                    <div style="background-color: black; color: white; padding: 20px;">

                        <div style="display: flow-root">
                            <?php
                            $date = date_create();

                            // First day of the month.
                            echo '<div style="float: left;"><b style="width: 30px">De:</b> <input id="date-start" style="width: 170px" type="date" class="form-control" value="'. date_format($date, 'Y-m-01') .'"></div>';

                            // Last day of the month.
                            echo '<div style="float: right;"><b style="width: 30px">Até:</b> <input id="date-end" style="width: 170px" type="date" class="form-control" value="'. date_format($date, 'Y-m-t') .'"></div>';

                            ?>
                        </div>
                    </div>
                    <div id="user-prod">

                    </div>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>

    </div>

    <script>

        $("#date-start").change(function () {
            callReportProd($("#date-start").val(), $("#date-end").val());
        });
        $("#date-end").change(function () {
            callReportProd($("#date-start").val(), $("#date-end").val());
        });



        function callReportProd(start, end){
            $("#user-prod").html(`<div style="margin: 20px auto; display: table;">@include('default.assets.load_spin')</div>`);

            $.ajax({
                url: 'inicio/user-prod',
                type: 'GET',
                data: `start=${start}&end=${end}`,
                success: (data) =>{
                    $("#user-prod").html(data);
                    if(data === ""){
                        $("#user-prod").html(`<div style="margin: 20px auto; display: table;">Nenhum dado foi encontrado nesse período</div>`);
                    }
                },
                error: (data) => {
                    console.log(data);
                }
            });
        }

        callReportProd($("#date-start").val(), $("#date-end").val());
    </script>

@stop