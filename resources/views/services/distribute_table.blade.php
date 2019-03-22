<span class='errors'>{{ $errors->first('msg') }}</span>
<table class="table-list">
    <tr class="table-head">
        <th class="elipsis"><input type="checkbox"></th>
        <th class="elipsis">Identificador</th>
        <th class="elipsis">Data recebido</th>
        <th class="elipsis">Tipo</th>
        <th class="elipsis">Endereço</th>
        <th class="elipsis">Latitude</th>
        <th class="elipsis">Longitude</th>
        <th class="elipsis">Descrição do serviço</th>
        <th class="elipsis">Página guia</th>
        <th class="elipsis">Solicitante</th>
        <th class="elipsis">Polo</th>
    </tr>
    @foreach($services as $service)
        <tr class="
            @if($service->lat != 0 && is_null($service->status_id))
                ready
            @elseif($service->lat == 0 && is_null($service->status_id))
                not-ready
            @elseif(!is_null($service->status_id))
                return
            @endif">
            <td class="center-text"><input type="checkbox" value="{!! $service->sid !!}" name="ids[]"></td>
            <td class="elipsis">{!! $service->identifier !!}</td>
            <td class="elipsis">{!! $service->date_received !!}</td>
            <td class="elipsis">{!! $service->type !!}</td>
            <td class="elipsis">{!! $service->address . ', ' . $service->n !!}</td>
            <td class="elipsis">{!! $service->lat !!}</td>
            <td class="elipsis">{!! $service->lng !!}</td>
            <td class="elipsis">{!! $service->service_description !!}</td>
            <td class="elipsis">{!! $service->pg_guia !!}</td>
            <td class="elipsis">{!! $service->name !!}</td>
            <td class="elipsis">{!! $service->polo !!}</td>
        </tr>
    @endforeach
</table>