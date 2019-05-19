@extends('default.master')
@section('title')
    Finalizar serviços
@stop

@section('stylecustom')
    <link rel="stylesheet" href="{{ URL::asset('public/css/distributeStyle.css') }}"/>
    <script type="text/javascript" src="{{ URL::asset('public/js/distributeScript.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('public/js/serviceScript.js') }}"></script>
@stop

@section('content')
    <form id="form-plan" method="post" enctype="multipart/form-data">
        <input type="file" multiple id="hidden-input-file-xlsx" name="plan" hidden>
    </form>
    <input type="file" id="hidden-input-file" hidden>
    <div class="gap-center-form">
        <div class="center-form max-size">
            <div id="table-content">

            </div>
            <input type="text" name="date" id="formDate" value="<?php $data = date_create(); echo date_format($data, 'Y-m-d'); ?>" hidden>
            <input type="text" name="userId" id="formUser" hidden>
        </div>
    </div>
@stop

@section('menuOptions')

    <table class="max-size" style="height: 100%;">
        <tr>
            <td>
                <input type="button" value="Importar planilha" class="btn btn-secondary" style="width: 100%; margin: 10px 0" id="import">
            </td>
        </tr>
        <tr>
            <td style="height: 100%; vertical-align: top;">
                @include('default.filters_service', array('type' => 'toFinalize'))
            </td>
        </tr>
    </table>

    <script>
        showMenuOptions();
        getTable();

        $("#import").click(function () {
            customAlert("<center>A planilha deve estar no padrão:</center>\n" +
                "| ID_de_distribuição | Observação | Foto1 | Foto2 | Foto3 | Foto4 | Foto5 |",
                function () {
                    $("#hidden-input-file-xlsx").click();
                });
        });

        $("#hidden-input-file-xlsx").change(function (e) {
            let files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                let extPermitidas = ['xlsx', 'xls'];
                if (typeof extPermitidas.find(function(ext){ return file.name.split('.').pop() === ext; }) == 'undefined') {
                    customAlert("Você deve selecionar</br>apenas arquivos excel");
                }else{
                    sendPlan();
                }
            }
        });


        function sendPlan() {
            var form = $('#form-plan')[0];
            var data = new FormData(form);
            showLoading();

            $.ajax({
                type: 'POST',
                url: 'api/end-service-plan',
                enctype: 'multipart/form-data',
                data: data,
                processData: false,
                contentType: false,
                success: function (data) {
                    closeBlackBackground();
                    $("#hidden-input-file-xlsx").val(null);
                    console.log(data);
                    if(data.code === 200){
                        data.data.forEach(function (row) {
                            if(row.status === 1){
                                $("#row-" + row.id).attr('class', 'executed');
                                $("#row-" + row.id + " > td > .btn-primary").attr('class', 'btn btn-primary btn-success').html("<i class='fas fa-plus'></i>");
                                $("#col-" + row.id).css('background-color', '#d4e6d9');
                            } else if(row.status === 3) {
                                $("#row-" + row.id).attr('class', 'return');
                                $("#row-" + row.id + " > td > .btn-warning").html("<i class='fas fa-undo'></i>");
                            }

                            row.photos.forEach(function (photo) {
                                $("#col-" + row.id).append("" +
                                    "<div class=\"img-container\">\n" +
                                    "     <img height='200px' src='"+ photo +"'/>" +
                                    "</div>");
                            })
                        })
                    } else {
                        customAlert(data.message);
                    }

                },
                error: function (data) {
                    console.log(data);
                }
            })
        }
    </script>

@stop