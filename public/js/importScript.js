$(document).ready(function(){
    $("#file").change(function(e) {
        var file = e.originalEvent.srcElement.files[0];
        var extPermitidas = ['xls', 'xlsx'];
        if(typeof extPermitidas.find(function(ext){ return file.name.split('.').pop() === ext; }) === 'undefined'){
            alert("Selecione uma planilha");
            $("#file").val(null);
        }else{
            $("#form").submit();
        }
    });
    
    $("#sltButton").click(function(){
        $("#file").val(null);
        $("#file").click();
    });

    $("#concat").change(function () {
        $("#labeN").toggleClass("hideClass showClass");
        $("#labeSlctN").toggleClass("hideClass showClass");
        $("#rowCompl").toggleClass("hideClass showClass");
    });

});

function clean(field){
    $(field).val("");
}