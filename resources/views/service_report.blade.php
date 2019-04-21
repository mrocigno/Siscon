<html>
    <head>
        <title>Relatório</title>
        @include('default.head')
        <script src="{!! URL::asset('public/js/printThis.js') !!}"></script>
        <script>
            $(document).ready(function () {
                $("#printer").click(function () {
                    $(".print-area").printThis();
                });
                closeBlackBackground();
                // $(".print-area").printThis();
            });
        </script>
    </head>
    <body>
        <div id="black-background" class="hideClass">
            <div id="alert-holder" class="center-form" style="display: none">
                <p id="alert-text">
                    Você tem certeza?
                </p>
                <div>
                    <input id="btnOk" type="button" class="btn btn-success" value="OK" style="width: 100%">
                </div>
            </div>

            <div id="msg-holder" class="center-form" style="display: none">
                <p class="msg-text">
                    Você tem certeza?
                </p>
                <table class="max-size">
                    <tr>
                        <td><input id="btnNo" type="button" class="btn btn-danger" value="Não" style="width: 100%"></td>
                        <td><input id="btnYes" type="button" class="btn btn-success" value="Sim" style="width: 100%"></td>
                    </tr>
                </table>
            </div>

            <div id="loading-holder" class="center-form" style="display: none">
                @include('default.assets.load_spin')
            </div>

            <div id="progress-holder" class="center-form" style="display: none">
                <p class="msg-text">Carregando... <i style="float: right" class="fas fa-spin fa-spinner"></i></p>
                <div id="progress-conteiner" class="progress" style="width:100%">
                    <div id="progress-value" class="progress-bar" role="progressbar" style="width:0%">
                    </div>
                </div>
            </div>
        </div>
        <script>
            showLoading();
        </script>
        @if(count($prints) > 0)
            <div style="display: table; margin: 10px auto; ">
                <button class="btn btn-primary" id="printer"><i class="fas fa-print"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Imprimir</button>
            </div>
            @foreach($prints as $print)
            <?php
                $status = $print->getStatus();
                $service = $print->getService();
                $photos = $print->getPhotos();
            ?>
            <div class="print-area">
                <table class="max-size">
                    <tr>
                        <td colspan="2">
                            <table cellspacing="0" class="max-size">
                                <tr class="{!! $status['class'] !!}">
                                    <th>
                                        <img style="width: 200px; margin: 10px" src="{{ \Illuminate\Support\Facades\Cookie::get("logo") }}"/>
                                    </th>
                                    <td style="text-align: end">
                                        {!! $status['description'] . " " . $status['icon'] !!}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center">
                            <h1>{!! $service->type !!}</h1>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Identificador:
                        </th>
                        <td style="width: 100%">
                            {!! $service->identifier !!}
                        </td>
                    </tr>
                    <tr>
                        <th class="elipsis">
                            Serviço:
                        </th>
                        <td style="width: 100%">
                            {!! $service->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th class="elipsis">
                            Endereço:
                        </th>
                        <td style="width: 100%">
                            {!! $service->address !!}, {!! $service->n !!}
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="elipsis" style="vertical-align: top">
                            Fotos:
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="row">
                                <table class="max-size">
                                    <tr>
                                        <?php $i = 0; ?>
                                        @foreach($photos as $photo)
                                            <td style="vertical-align: top">
                                                <img style="width: 100%" src="{!! $photo->link !!}">
                                            </td>
                                            @if(++$i == 3)
                                    </tr>
                                    <?php $i = 0; ?>
                                    <tr>
                                        @endif
                                        @endforeach
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        @endforeach
        @else
            <div style="display: table; margin: 200px auto 0; text-align: center">
                <h1>Neste relatório só aparecerá serviços "Executados" e "Não executados"</h1>
            </div>
        @endif
    </body>
</html>