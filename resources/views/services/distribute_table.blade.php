<span class='errors'>{{ $errors->first('msg') }}</span>
<div class="table-list div-table" id="services-table" style="position: relative">
    <label class="table-head div-table-row">
        <div class="div-table-th">
            <input type="checkbox" class="check-input" id="check-all" onchange="selectAll(this)">
            {{--<label for="check-all" class="check-white">--}}
                {{--<svg width="15px" height="15px" viewBox="0 0 18 18">--}}
                    {{--<path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>--}}
                    {{--<polyline points="1 9 7 14 15 4"></polyline>--}}
                {{--</svg>--}}
            {{--</label>--}}
        </div>
        <div class="elipsis div-table-th">Id</div>
        <div class="elipsis div-table-th">Identificador</div>
        <div class="elipsis div-table-th">Data recebido</div>
        <div class="elipsis div-table-th">Tipo</div>
        <div class="elipsis div-table-th">Endereço</div>
        <div class="elipsis div-table-th">Latitude</div>
        <div class="elipsis div-table-th">Longitude</div>
        <div class="elipsis div-table-th">Descrição do serviço</div>
        <div class="elipsis div-table-th">Página guia</div>
        <div class="elipsis div-table-th">Solicitante</div>
        <div class="elipsis div-table-th">Polo</div>
        <div class="elipsis div-table-th">Remessa</div>
    </label>
    @if($services->count() > 0)
        @foreach($services as $service)
            <label class="<?php echo \App\Utils\StatusUltil::getStatus($service->status_id, true)['class'] ?> clickable div-table-row" for="check-{!! $service->sid !!}">
                <div class="center-text div-table-td" style="padding: 0">
                    <input type="checkbox" value="{!! $service->sid !!}" id="check-{!! $service->sid !!}" name="ids[]" class="check-input" style="z-index: 20">
                    {{--<label for="check-{!! $service->sid !!}" class="check">--}}
                        {{--<svg width="15px" height="15px" viewBox="0 0 18 18">--}}
                            {{--<path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>--}}
                            {{--<polyline points="1 9 7 14 15 4"></polyline>--}}
                        {{--</svg>--}}
                    {{--</label>--}}
                </div>
                <div class="elipsis div-table-td"><a target="_blank" href="servicos/{!! $service->sid !!}" style="color: blue; font-weight: bold">{!! $service->sid !!}</a></div>
                <div class="elipsis div-table-td">{!! $service->identifier !!}</div>
                <div class="elipsis div-table-td">{!! $service->date_received !!}</div>
                <div class="elipsis div-table-td">{!! $service->type !!}</div>
                <div class="elipsis div-table-td">{!! $service->address . ', ' . $service->n !!}</div>
                <div class="elipsis div-table-td">{!! $service->lat !!}</div>
                <div class="elipsis div-table-td">{!! $service->lng !!}</div>
                <div class="elipsis div-table-td">{!! $service->service_description !!}</div>
                <div class="elipsis div-table-td">{!! $service->pg_guia !!}</div>
                <div class="elipsis div-table-td">{!! $service->applicant !!}</div>
                <div class="elipsis div-table-td">{!! $service->polo !!}</div>
                <div class="elipsis div-table-td">{!! $service->delivery !!}</div>
            </label>
        @endforeach
    @else
        <div class="div-table-row" style="height: 52px">
            <div style="position: absolute; top: 31px; left: 0; right: 0">
                {{--<span class="div-table-td">--}}
                <h1 style="text-align: center">Nenhum registro encontrado</h1>
                {{--</span>--}}
            </div>
        </div>
    @endif
</div>
<script>
    const boxes = Array.from(document.querySelectorAll('#services-table .check-input'));

    let lastChecked;

    function changeBox(event) {
        if (event.shiftKey && this !== lastChecked) {
            checkIntermediateBoxes(lastChecked, this);
        }
        lastChecked = this;
    }

    boxes.forEach(item => item.addEventListener('click', changeBox));

    function checkIntermediateBoxes(first, second) {
        if (boxes.indexOf(first) > boxes.indexOf(second)) {
            [second, first] = [first, second];
        }
        intermediateBoxes(first, second).forEach(box => box.checked = true);
    }

    function intermediateBoxes(start, end) {
        return boxes.filter((item, key) => {
            return boxes.indexOf(start) < key && key < boxes.indexOf(end);
        });
    }
</script>