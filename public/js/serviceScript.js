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

function storeImg(b64, randId, sid){
    console.log("img=" + b64);
    $.ajax({
        type: 'POST',
        url: 'api/save-b64',
        data: {
            img: b64,
            id: sid
        },
        success: function (data) {
            console.log(data);
            $("#" + randId).remove();
        },
        error: function (ex) {
            console.log(ex);
            $("#" + randId + " > div").html("<b style='margin-top: 10px'>Erro ao fazer upload da imagem</b>");
        }
    });
}

var row;
var sid;
function finalize(id) {
    $("#hidden-input-file").click();
    row = "col-" + id;
    sid = id;
}

$(document).ready(function () {
    $("#hidden-input-file").change(function(e) {
        let files = e.target.files;
        for (let i = 0; i < files.length; i++) {
            let file = files[i];
            let extPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
            if (typeof extPermitidas.find(function(ext){ return file.name.split('.').pop() === ext; }) == 'undefined') {
                customAlert("Você deve selecionar</br>apenas imagens");
                console.log("asdsasd");
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
                        $("#" + row).append("" +
                            "<div class=\"img-container\">\n" +
                            "     <img src='"+ dataurl +"'/>" +
                            "     <div id='"+ randId +"' class=\"loding-img-container\">\n" +
                            "         <div style=\"display: table; margin: auto;\">\n" +
                            "           <div class='loading-spin fa-spin'></div>"+
                            "         </div>\n" +
                            "     </div>\n" +
                            "</div>");

                        storeImg(dataurl, randId, sid);
                        $("#hidden-input-file").val(null);
                    }
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    });
});