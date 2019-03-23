<form name="form-filter" id="form-filter">
    <input type="hidden" value="{!! $type !!}" name="_type">
    <table class="max-size">
        <tr>
            <th colspan="2">Ordernar por</th>
        </tr>
        <tr>
            <td colspan="2">
                <select class="form-control" name="order" onchange="showLatLng(this);">
                    <option value="sid">-- Selecione --</option>
                    <option value="distance">Distância</option>
                    <option value="date_received">Data recebido</option>
                </select>
            </td>
        </tr>
        <tr class="hideClass latLngRow">
            <th>
                Lat
            </th>
            <th>
                Lng
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
            <th colspan="2">
                Lista de identificadores
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