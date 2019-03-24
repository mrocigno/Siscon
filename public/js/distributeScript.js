function setValue(value, to){
    $("#" + to).val(value);
}

function confirmDistribute(){
    let user = $("#for").val();
    let date = $("#date").val();
    if(user === ""){
        customAlert("Informe o usuário");
        return;
    }else{
        $("#formUser").val(user);
    }
    if(date === ""){
        customAlert("Informe a data");
        return;
    }else{
        $("#formDate").val(date);
    }
    submitYesNo('create-route')
}

