$(document).ready(function () {
    $("#fromBD").click(function () {
        $("#hided").toggleClass("hideClass showClassRow");
    });

    $("#add").click(function () {
        if($("#fromBD").prop("checked")){
            addNewField($("#fields option:selected").html(), "{"+ $("#fields").val() +"}");
        } else {
            addNewField("", "");
        }
        refreshReportView();
    });

    $("#service_type").change(function(){
        changeTitle();
    });

    $("#save").click(function () {
        if(checkForm()){
            submitYesNo('form');
        }
    });

    $("#printer").click(function () {
        $(".print-area").printThis();
    });

    $("#boxes").sortable({
        axis: "y",
        update: function(event, ui) {
            refreshReportView();
        }
    }).disableSelection();
});

let rows = 0;
function addNewField(field, value, type){
    rows++;
    $("#boxes").append(getBox(rows, field, value));

    $(".refresh").change(function () {
        refreshReportView();
    });

    let row = rows;
    $("#type_" + row).change(function () {
        checkDefault(row);
    }).val(type);
    checkDefault(row);
}

function checkDefault(row) {
    if($("#type_" + row).val() === "2"){
        $("#rowCheck_" + row).toggleClass("hideClass showClassRow");
    } else {
        if($("#rowCheck_" + row).hasClass("showClassRow")){
            $("#rowCheck_" + row).toggleClass("hideClass showClassRow");
        }
    }
}

function changeTitle() {
    if($("#service_type").val() === ""){
        $("#title").html("{Service type}");
    } else {
        $("#title").html($("#service_type option:selected").html());
    }
}

function refreshReportView() {
    $("#table-report").html("");

    let len = $("#boxes").children().length;
    for (let li = 1; li <= len; li++) {
        let child = $("#boxes").children().eq(li - 1);
        $(child.children().first()).val(li);
        let i = $(child.children().first()).attr("name").replace("order_", "");

        if($("#show_" + i).prop("checked")){
            var value;
            let type = $("#type_" + i).val();
            switch (type) {
                case "1":{
                    value = getInputValue(i);
                    break;
                }
                case "2":{
                    let checked = ($("#check_" + i).prop("checked")? "checked":"")
                    value = getCheckValue(i, checked);
                    break;
                }
                default:{
                    value = $("#value_" + i).val();
                }
            }

            $("#table-report").append(getRow($("#name_" + i).val(), value));
        }
    }

}

function checkForm(){
    let bols = [checkField($("#service_type"))];
    for (i = 1; i <= rows; i++){
        if($("#show_" + i).prop("checked")){
            bols.push(checkField($("#name_" + i)));
            bols.push(checkField($("#type_" + i)));
        }
    }
    return !(bols.includes(false) > 0);
}

function checkField(field){
    if($(field).val() === ""){
        $(field).addClass('is-invalid');
        return false;
    } else {
        $(field).removeClass('is-invalid');
        return true;
    }
}

// *******************************
//           Resources
// *******************************

function getBox(row, name, value) {
    return `
        <li class="box-fields">
            <input type="number" class="row-box" name="order_${row}" value="${row}" hidden>
            <table class="max-size">
                <tr style="background-color: #222d4c; color: white; font-weight: bold">
                    <td>
                        <input id="show_${row}" style="display: none" class="check-input refresh" name="show[]" value="${row}" type="checkbox" checked>
                        <label for="show_${row}" class="check-white">
                            <svg width="15px" height="15px" viewBox="0 0 18 18">
                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                <polyline points="1 9 7 14 15 4"></polyline>
                            </svg>
                        </label>
                        <label for="show_${row}" style="padding: 0; margin: 0">Exibir</label>
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
                        <input type="text" id="name_${row}" name="name_${row}" class="form-control refresh" value="${name}">
                    </td>
                </tr>
                <tr>
                    <td>
                        Valor:
                    </td>
                    <td>
                        <input type="text" id="value_${row}" name="value_${row}" class="form-control refresh" value="${value}">
                    </td>
                </tr>
                <tr>
                    <td>
                        Tipo:
                    </td>
                    <td>
                        <select id="type_${row}" name="type_${row}" class="form-control refresh">
                            <option value="0">Texto</option>
                            <option value="1">Campo para escrita</option>
                            <option value="2">Checkbox</option>
                        </select>
                    </td>
                </tr>
                <tr class="hideClass" id="rowCheck_${row}">
                    <td>
                        Check:
                    </td>
                    <td>
                        <input id="check_${row}" style="display: none" class="check-input refresh" name="check_${row}" value="1" type="checkbox" checked>
                        <label for="check_${row}" class="check">
                            <svg width="15px" height="15px" viewBox="0 0 18 18">
                                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                                <polyline points="1 9 7 14 15 4"></polyline>
                            </svg>
                        </label>
                        <label for="check_${row}" style="padding: 0; margin: 0">Exibir</label>
                    </td>
                </tr>
            </table>
        </li>
    `;
}

function getInputValue(row) {
    return `<input type="text" value="${$("#value_" + row).val()}" class="form-control">`;
}

function getCheckValue(row, checked) {
    return `<input id="field_${row}" style="display: none" class="check-input" name="show[]" value="1" type="checkbox" ${checked}>
    <label for="field_${row}" class="check">
        <svg width="15px" height="15px" viewBox="0 0 18 18">
            <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
            <polyline points="1 9 7 14 15 4"></polyline>
        </svg>
    </label>
    <label for="field_${row}" style="padding: 0; margin: 0">${$("#value_" + row).val()}</label>`;
}

function getRow(name, value){
    return `<tr>
        <th class="elipsis">
            ${name}:
        </th>
        <td style="width: 100%">
            ${value}
        </td>
    </tr>`;
}