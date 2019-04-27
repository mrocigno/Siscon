<div class="box-fields">
    <table class="max-size">
        <tr style="background-color: #222d4c; color: white; font-weight: bold">
            <td>
                <input id="show_${rows}" style="display: none" class="check-input refresh" name="show[]" value="${rows}" type="checkbox" checked>
                <label for="show_${rows}" class="check-white">
                    <svg width="15px" height="15px" viewBox="0 0 18 18">
                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                        <polyline points="1 9 7 14 15 4"></polyline>
                    </svg>
                </label>
                <label for="show_${rows}" style="padding: 0; margin: 0">Exibir</label>
            </td>
            <td class="cell-reorder">
                <i class="fas fa-sort"></i>
            </td>
        </tr>
    </table>
    <table class="max-size">
        <tr>
            <td>
                Nome:
            </td>
            <td>
                <input type="text" id="name_${rows}" name="name_${rows}" class="form-control refresh" value="${field}">
            </td>
        </tr>
        <tr>
            <td>
                Valor:
            </td>
            <td>
                <input type="text" id="value_${rows}" name="value_${rows}" class="form-control refresh" value="${value}">
            </td>
        </tr>
        <tr>
            <td>
                Tipo:
            </td>
            <td>
                <select id="type_${rows}" name="type_${rows}" class="form-control refresh">
                    <option value="0">Texto</option>
                    <option value="1">Campo para escrita</option>
                    <option value="2">Checkbox</option>
                </select>
            </td>
        </tr>
        <tr class="hideClass" id="rowCheck_${rows}">
            <td>
                Padrão:
            </td>
            <td>
                <input id="check_${rows}" style="display: none" class="check-input refresh" name="check_${rows}" value="1" type="checkbox" checked>
                <label for="check_${rows}" class="check">
                    <svg width="15px" height="15px" viewBox="0 0 18 18">
                        <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                        <polyline points="1 9 7 14 15 4"></polyline>
                    </svg>
                </label>
                <label for="check_${rows}" style="padding: 0; margin: 0">Exibir</label>
            </td>
        </tr>
    </table>
</div>
