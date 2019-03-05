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
});