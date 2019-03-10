<table id="user-table">
    <tr class="table-head">
        <th class="elipsis">
            Olá, {{ Auth::user()->name }}
        </th>
    </tr>
    <tr>
        <td>
            <a href="{{ URL::asset('logout') }}">Sair</a>
        </td>
    </tr>
</table>
