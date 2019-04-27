@extends('admin.default')
@section('title')
    Adicionar layout de relatório
@stop

@section('add')

    <!-- Modal -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar campo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="max-size">
                        <tr>
                            <td>
                                @include('default.assets.checkbox', array('name' => 'fromBD', 'class' => 'check'))
                                <label for="fromBD">Buscar do banco de dados</label>
                            </td>
                        </tr>
                        <tr class="hideClass" id="hided">
                            <td>
                                <select name="fields" id="fields" class="form-control">
                                    <option value="sid">ID do serviço</option>
                                    <option value="identifier">Identificador</option>
                                    <option value="description">Descrição do serviço</option>
                                    <option value="address">Endereço</option>
                                    <option value="observation">Observações de execução</option>
                                    <option value="user_name">Motoboy</option>
                                    <option value="applicant">Solicitante</option>
                                </select>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="add">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="print-area">
        <table class="max-size">
            <tr>
                <td colspan="2">
                    <table cellspacing="0" class="max-size">
                        <tr class="executed">
                            <th>
                                <img style="width: 200px; margin: 10px" src="{{ \Illuminate\Support\Facades\Cookie::get("logo") }}"/>
                            </th>
                            <td style="text-align: end">
                                {description_status}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" style="text-align: center">
                    <h1>{Service type}</h1>
                </th>
            </tr>
        </table>
        <table class="max-size" id="table-report">

        </table>
    </div>

@stop

@section('menuOptions')


    <table class="max-size" style="height: 100%">
        <tr>
            <td>
                <div class="btn btn-info" style="width: 100%; margin-bottom: 5px" data-toggle="modal" data-target="#modalExemplo">Adicionar campo</div>
                <div class="btn btn-primary" style="width: 100%; margin-bottom: 5px" id="printer">Visualizar</div>
                <div class="btn btn-success" style="width: 100%" id="printer">Salvar</div>
            </td>
        </tr>
        <tr>
            <td id="boxes" style="height: 100%">

            </td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 12px">
                O campo de imagens é adicionado automaticamente ao final da pagina
            </td>
        </tr>
    </table>

    <script src="{!! URL::asset('public/js/printThis.js') !!}"></script>
    <script>
        $("#fromBD").click(function () {
            $("#hided").toggleClass("hideClass showClassRow");
        });

        $("#add").click(function () {

            if($("#fromBD").prop("checked")){
                addNewField($("#fields option:selected").html(), "{"+ $("#fields").val() +"}");
            } else {
                addNewField("", "");
            }
            refreshReportView();
        })

        let rows = 0;
        function addNewField(field, value){
            rows++;
            $("#boxes").append(`@include('default.assets.box_report')`);
            $(".refresh").change(function () {
                refreshReportView();
            });
            let row = rows;
            $("#type_" + row).change(function () {
                if($(this).val() === "2"){
                    $("#rowCheck_" + row).toggleClass("hideClass showClassRow");
                } else {
                    if($("#rowCheck_" + row).hasClass("showClassRow")){
                        $("#rowCheck_" + row).toggleClass("hideClass showClassRow");
                    }
                }
            })
        }


        function refreshReportView() {
            $("#table-report").html("");

            for (i = 1; i <= rows; i++) {
                if($("#show_" + i).prop("checked")){
                    var value;
                    let type = $("#type_" + i).val();
                    switch (type) {
                        case "1":{
                            value = `<input type="text" value="${$("#value_" + i).val()}" class="form-control">`;
                            break;
                        }
                        case "2":{
                            let checked = ($("#check_" + i).prop("checked")? "checked":"")
                            value = `
                            <input id="field_${i}" style="display: none" class="check-input" name="show[]" value="1" type="checkbox" ${checked}>
                            <label for="field_${i}" class="check">
                                <svg width="15px" height="15px" viewBox="0 0 18 18">
                                    <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                    <polyline points="1 9 7 14 15 4"></polyline>
                                </svg>
                            </label>
                            <label for="field_${rows}" style="padding: 0; margin: 0">${$("#value_" + i).val()}</label>`;
                            break;
                        }
                        default:{
                            value = $("#value_" + i).val();
                        }
                    }

                    $("#table-report").append(`
                        <tr>
                            <th class="elipsis">
                                ${$("#name_" + i).val()}:
                            </th>
                            <td style="width: 100%">
                                ${value}
                            </td>
                        </tr>
                    `);
                }
            }
        }

        $("#printer").click(function () {
            $(".print-area").printThis();
        });

        showMenuOptions();
        refreshReportView();
    </script>

@stop