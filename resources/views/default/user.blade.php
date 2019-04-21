<table id="user-table">
    <tr class="table-head">
        <th class="elipsis">
            Olá, @if(isset(Auth::user()->name)){{ Auth::user()->name }} @else visitante! @endif
        </th>
    </tr>
    <tr>
        <td>
            @if(isset(Auth::user()->name))
                <a href="{{ URL::asset('logout') }}">Sair</a>
            @else
                <a href="{{ URL::asset('login') }}">Logar</a>
            @endif
        </td>
    </tr>
</table>
