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
    <a href='{{ URL::to('/') }}/importar'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-file-excel"></i></td>
                <td>Importar serviços</td>
            </tr>
        </table>
    </a>
</div>
<div class="item">
    <a href="{{ URL::to('/') }}/distribuir">
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-share"></i></td>
                <td>Distribuir serviços</td>
            </tr>
        </table>
    </a>
</div>
<div class="item">
    <a href='{{ URL::to('/') }}/finalizar'>
        <table>
            <tr>
                <td class="iconMenu"><i class="fas fa-exchange-alt"></i></td>
                <td>Finalizar serviços</td>
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