function showLatLng(dom){
    if($(dom).val() === "distance"){
        $(".latLngRow").toggleClass("hideClass showClassRow");
    } else {
        if($(".latLngRow").hasClass("showClassRow")){
            $(".latLngRow").toggleClass("hideClass showClassRow");
        }
    }
}

function getTable(){
    showLoading();
    $("#table-content").html("<center><h2>Carregando...</h2></center>");
    $.ajax({
        type: 'GET',
        url: 'servicos/get-table',
        data: $("#form-filter").serialize(),
        success: function (data) {
            $("#table-content").html(data);
            closeBlackBackground();
        },
        error: function (ex) {
            console.log(ex);
            plusValueProgress();
            closeBlackBackground();
        }
    });
}

function endService(b64, randId, sid, row){
    console.log("img=" + b64);
    $.ajax({
        type: 'POST',
        url: 'api/end-service',
        data: {
            img: b64,
            id: sid
        },
        success: function (data) {
            console.log(data);
            $("#" + randId).remove();
            $("#" + row).toggleClass('delivered executed');
            $("#" + row + " > td > input").toggleClass('btn-primary btn-success').val("Adicionar mais");

        },
        error: function (ex) {
            console.log(ex);
            $("#" + randId + " > div").html("<b style='margin-top: 10px'>Erro ao fazer upload da imagem</b>");
        }
    });
}

let col, row, sid;
function finalize(id) {
    $("#hidden-input-file").click();
    col = "col-" + id;
    row = "row-" + id;
    sid = id;
}

function rowClick(dom){
    let id = $(dom).parent().attr('data-id');
    window.location = "inicio";
}

$(document).ready(function () {
    $("#hidden-input-file").change(function(e) {
        let files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let extPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
            if (typeof extPermitidas.find(function(ext){ return file.name.split('.').pop() === ext; }) == 'undefined') {
                customAlert("Você deve selecionar</br>apenas imagens");
            }else{
                var reader = new FileReader();
                // Set the image once loaded into file reader
                reader.onload = function(e) {
                    var img = document.createElement("img");
                    img.onload = function(){
                        var canvas = document.createElement("canvas");
                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0);

                        var MAX_WIDTH = 250;
                        var MAX_HEIGHT = 250;
                        var width = img.width;
                        var height = img.height;

                        if (width > height) {
                            if (width > MAX_WIDTH) {
                                height *= MAX_WIDTH / width;
                                width = MAX_WIDTH;
                            }
                        } else {
                            if (height > MAX_HEIGHT) {
                                width *= MAX_HEIGHT / height;
                                height = MAX_HEIGHT;
                            }
                        }
                        canvas.width = width;
                        canvas.height = height;
                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(img, 0, 0, width, height);

                        dataurl = canvas.toDataURL(file.type);
                        let randId = "load-" + Math.floor(Math.random() * 1000);
                        $("#" + col).append("" +
                            "<div class=\"img-container\">\n" +
                            "     <img src='"+ dataurl +"'/>" +
                            "     <div id='"+ randId +"' class=\"loding-img-container\">\n" +
                            "         <div style=\"display: table; margin: auto;\">\n" +
                            "           <div class='loading-spin fa-spin'></div>"+
                            "         </div>\n" +
                            "     </div>\n" +
                            "</div>");

                        endService(dataurl, randId, sid, row);
                        $("#hidden-input-file").val(null);
                    }
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    });
});