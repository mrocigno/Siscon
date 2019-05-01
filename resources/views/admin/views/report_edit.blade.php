@extends('admin.default')
@section('title')
    Editar layout de folha de impressão
@stop

@section('header_custom')
    <script src="{!! URL::asset('public/js/printThis.js') !!}"></script>
    <script src="{!! URL::asset('public/js/jquery-ui.js') !!}"></script>
    <script src="{!! URL::asset('public/js/reportsScript.js') !!}"></script>
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
                    <h1 id="title">{Service type}</h1>
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
                <div class="btn btn-success" style="width: 100%" id="save">Salvar</div>
            </td>
        </tr>
        <tr>
            <td style="height: 100%; vertical-align: top;">
                <form id="form" action="../update" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" value="{!! $report->id !!}" name="id">
                    <label for="service_type">Tipo do serviço</label>
                    <select class="form-control" name="service_type" id="service_type">
                        <option value="">-- Selecione --</option>
                        @foreach($types as $type)
                            <option value="{!! $type->id !!}">{!! $type->type !!}</option>
                        @endforeach
                    </select>

                    <ul style="padding: 0;" id="boxes">

                    </ul>
                </form>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; font-size: 12px">
                O campo de imagens é adicionado automaticamente ao final da pagina
            </td>
        </tr>
    </table>
    <script>
        <?php
            $fields = json_decode($report->fields_json);
            foreach ($fields as $field){
                echo 'addNewField("'. $field->name .'", "'. $field->value .'", "'. $field->type .'");';
            }
        ?>
        showMenuOptions();
        refreshReportView();
        $("#service_type").val({!! $report->service_type_id !!});
        changeTitle();
    </script>
@stop