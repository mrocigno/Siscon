<div class="center-form max-size">
    <div style="background-color: black; color: white; padding: 20px;">
        Por dia
    </div>
    @foreach($query as $row)
        <div>
            <div style="background-color: #B0BEC5; padding: 5px 20px">
            <span>
                <b>Atribuido para:</b> {!! $row['row']->name !!}
            </span>
            <span style="margin-left: 5px">
                <b>no dia:</b> <?php $date = date_create($row['row']->distributed_date);echo date_format($date, 'd/m/Y'); ?>
            </span>
                <span style="float: right">
                <b>Total:</b> {!! $row['row']->total !!}
            </span>
            </div>

            @foreach($row['data'] as $data)
                <div style="display: flex; position: relative">
                    <i style="transform: rotate(90deg); float: left; margin: 5px 15px 5px 30px" class="fas fa-level-up-alt"></i>
                    <div style="float: left; width: 150px; text-align: center; margin-right: 15px" class="<?php echo \App\Utils\StatusUltil::getStatus($data->status_id, true)['class']; ?>">
                        {!! $data->status !!}
                    </div>
                    <span><b>Quantidade:</b> {!! $data->total !!}</span>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
