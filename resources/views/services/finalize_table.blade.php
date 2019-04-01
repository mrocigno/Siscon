<span class='errors'>{{ $errors->first('msg') }}</span>
<table class="table-list">
    <tr class="table-head">
        <th>
            Ação
            {{--<label for="check-all" class="check-white">--}}
            {{--<svg width="15px" height="15px" viewBox="0 0 18 18">--}}
            {{--<path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>--}}
            {{--<polyline points="1 9 7 14 15 4"></polyline>--}}
            {{--</svg>--}}
            {{--</label>--}}
        </th>
        <th class="elipsis">Id de distribuição</th>
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
        <th class="elipsis">Remessa</th>
    </tr>
    @foreach($services as $service)
        <tr id="row-{!! $service->did !!}" class="{!! \App\Utils\StatusUltil::getStatus($service->status_id, true)['class'] !!}">
            <td class="center-text">
                <input class="btn btn-primary finalize-btn" type="button" value="Finalizar" onclick="finalize({!! $service->did !!})">
            </td>
            <td class="elipsis">{!! $service->did !!}</td>
            <td class="elipsis">{!! $service->identifier !!}</td>
            <td class="elipsis">{!! $service->date_received !!}</td>
            <td class="elipsis">{!! $service->type !!}</td>
            <td class="elipsis">{!! $service->address . ', ' . $service->n !!}</td>
            <td class="elipsis">{!! $service->lat !!}</td>
            <td class="elipsis">{!! $service->lng !!}</td>
            <td class="elipsis">{!! $service->service_description !!}</td>
            <td class="elipsis">{!! $service->pg_guia !!}</td>
            <td class="elipsis">{!! $service->applicant !!}</td>
            <td class="elipsis">{!! $service->polo !!}</td>
            <td class="elipsis">{!! $service->delivery !!}</td>
        </tr>
        <tr class="img-content">
            <td colspan="13" style="text-align: left; padding: 0; box-shadow: inset 0px 0px 18px 0px rgba(0,0,0,0.75);" id="col-{!! $service->did !!}">

            </td>
        </tr>
    @endforeach
</table>