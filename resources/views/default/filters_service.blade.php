<form name="form-filter" id="form-filter">
    <input type="hidden" value="{!! $type !!}" name="_type">
    <table class="max-size">
        <tr>
            <th colspan="2">
                Ordernar por:
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <table class="max-size">
                    <tr>
                        <td style="padding: 0">
                            <select class="form-control"  name="order" onchange="showLatLng(this);">
                                <option value="sid">-- Selecione --</option>
                                <option value="distance">Distância</option>
                                <option value="date_received">Data recebido</option>
                                <option value="status_id">Status</option>
                            </select>
                        </td>
                        <td style="padding-left: 5px">
                            <select class="form-control"  name="direction">
                                <option value="asc">↓</option>
                                <option value="desc">↑</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="hideClass latLngRow">
            <th>
                Lat:
            </th>
            <th>
                Lng:
            </th>
        </tr>
        <tr class="hideClass latLngRow">
            <td>
                <input type="text" name="lat" class="form-control">
            </td>
            <td>
                <input type="text" name="lng" class="form-control">
            </td>
        </tr>
        <tr>
            @if(isset($statuses))
                <th>
                    Status:
                </th>
            @endif
            @if(isset($types))
                <th>
                    Tipo:
                </th>
            @endif
        </tr>
        <tr>
            @if(isset($statuses))
                <td>
                    <select name="status" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($statuses as $status)
                            <option value="{!! $status->id !!}">{!! $status->status !!}</option>
                        @endforeach
                    </select>
                </td>
            @endif
            @if(isset($types))
                <td>
                    <select name="type" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($types as $type)
                            <option value="{!! $type->id !!}">{!! $type->type !!}</option>
                        @endforeach
                    </select>
                </td>
            @endif
        </tr>
        @if(isset($externalUsers))
            <tr>
                <th colspan="2">
                    Data executado:
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="date" name="executed_date" class="form-control"/>
                </td>
            </tr>
            <tr>
                <th>
                    Usuário:
                </th>
            </tr>
            <tr>
                <td colspan="2">
                    <select name="user" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($externalUsers as $externalUser)
                            <option value="{!! $externalUser->id !!}">{!! $externalUser->name !!}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        @endif
        <tr>
            <th colspan="2">
                Lista de identificadores:
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <textarea name="identifiers" class="form-control" style="height: 100px"></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" class="btn btn-success" style="float: right;" id="filter" name="filter" value="Filtrar" onclick="getTable();">
            </td>
        </tr>
    </table>
</form>