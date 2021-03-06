<span class='errors'>{{ $errors->first('msg') }}</span>
<table class="table-list">
    <tr class="table-head">
        <th class="elipsis">
            Marcar como
            {{--<label for="check-all" class="check-white">--}}
            {{--<svg width="15px" height="15px" viewBox="0 0 18 18">--}}
            {{--<path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>--}}
            {{--<polyline points="1 9 7 14 15 4"></polyline>--}}
            {{--</svg>--}}
            {{--</label>--}}
        </th>
        <th class="elipsis">Id</th>
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
    @if($services->count() > 0)
        @foreach($services as $service)
            <tr id="row-{!! $service->did !!}" class="{!! \App\Utils\StatusUltil::getStatus($service->status_id, true)['class'] !!}">
                <td class="elipsis">
                    <button class="btn btn-primary finalize-btn" onclick="finalizeExecuted({!! $service->did !!})" style="padding: 5px 5px; width: 30px"><i class='fas fa-check'></i></button>
                    <button class="btn btn-danger" type="button" onclick="finalizeNotExecuted({!! $service->did !!})" style="padding: 5px 5px; width: 30px"><i class='fas fa-times'></i></button>
                    <button class="btn btn-warning" type="button" onclick="finalizeReturn({!! $service->did !!})" style="padding: 5px 5px; width: 30px"><i class='fas fa-undo'></i></button>
                </td>
                <td class="elipsis"><a target="_blank" href="servicos/{!! $service->sid !!}" style="color: blue; font-weight: bold">{!! $service->sid !!}</a></td>
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
                <td colspan="14" style="text-align: left; padding: 0; box-shadow: inset 0 0 8px 0 rgba(0,0,0,0.75);" id="col-{!! $service->did !!}"></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="13">
                <h1>Nenhum registro encontrado</h1>
            </td>
        </tr>
    @endif
</table>