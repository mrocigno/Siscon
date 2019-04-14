<img src="{{ URL::asset('public/img/logo.png') }}" id="logo"/>
<div class="item">
    <a href='{{ URL::to('/') }}/inicio'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-home"></i></td>
                <td>Inicio</td>
            </tr>
        </table>
    </a>
</div>
<div class="item">
    <a href='{{ URL::to('/') }}/servicos'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-file-alt"></i></td>
                <td>Serviços</td>
            </tr>
        </table>
    </a>
</div>
<ul style="list-style-type: none; margin: 0">
    <li>
        <div class="item">
            <a href='{{ URL::to('/') }}/adicionar'>
                <table>
                    <tr>
                        <td class="iconMenu"><i class="fas fa-file-excel"></i></td>
                        <td>Adicionar</td>
                    </tr>
                </table>
            </a>
        </div>
    </li>
    <li>
        <div class="item">
            <a href="{{ URL::to('/') }}/distribuir">
                <table>
                    <tr>
                        <td class="iconMenu"><i class="fas fa-share"></i></td>
                        <td>Distribuir</td>
                    </tr>
                </table>
            </a>
        </div>
    </li>
    <li>
        <div class="item">
            <a href='{{ URL::to('/') }}/finalizar'>
                <table>
                    <tr>
                        <td class="iconMenu"><i class="fas fa-exchange-alt"></i></td>
                        <td>Finalizar</td>
                    </tr>
                </table>
            </a>
        </div>
    </li>
</ul>

<div class="item">
    <a href='{{ URL::to('/') }}/administrar-campos'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-book"></i></td>
                <td>Administração</td>
            </tr>
        </table>
    </a>
</div>

{{--<div class="item">--}}
{{--    <a href='{{ URL::to('/') }}/remessa/lista'>--}}
{{--        <table>--}}
{{--            <tr>--}}
{{--                <td class="iconMenu"><i class="fas fa-people-carry"></i></td>--}}
{{--                <td>Remessas</td>--}}
{{--            </tr>--}}
{{--        </table>--}}
{{--    </a>--}}
{{--</div>--}}