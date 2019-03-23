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
<div class="item">
    <a href='{{ URL::to('/') }}/administrar-campos'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-book"></i></td>
                <td>Administrar campos</td>
            </tr>
        </table>
    </a>
</div>

<div class="item">
    <a href='{{ URL::to('/') }}/remessa/lista'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-people-carry"></i></td>
                <td>Remessas</td>
            </tr>
        </table>
    </a>
</div>