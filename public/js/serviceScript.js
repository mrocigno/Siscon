function showLatLng(dom){
    if($(dom).val() === "distance"){
        $(".latLngRow").toggleClass("hideClass showClassRow");
    } else {
        $("#filter-lat").val("");
        $("#filter-lng").val("");
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

let sid;
function finalizeExecuted(id) {
    $("#hidden-input-file").click();
    sid = id;
}

function finalizeNotExecuted(id){
    inputAlert("Motivo por não executar", function (value) {
        sid = id;
        $("#row-" + id + " > td > .btn-danger").html("<i class='fas fa-spin fa-spinner'></i>");
        endService(null, sid, 2, value, null);
    });
}

function finalizeReturn(id) {
    sid = id;
    $("#row-" + id + " > td > .btn-warning").html("<i class='fas fa-spin fa-spinner'></i>");
    endService(null, sid, 3, null, null);
}

function printServices(){
    let rows = $('.table-list .check-input');
    for(i = 0; i < rows.length; i++){
        let row = rows[i];
        if($(row).prop('checked')){
            $("#form").attr('action', 'servicos/imprimir').attr('method', 'post').submit();
            return;
        }
    }
    customAlert("Selecione ao menos 1 serviço");
}

function generateMap(){
    let rows = $('.table-list .check-input');
    for(i = 0; i < rows.length; i++){
        let row = rows[i];
        if($(row).prop('checked')){

            rebrandly($("#form").serialize(), function (url) {
                inputAlert("Url do mapa gerado", function (urlShort) {
                    window.open(urlShort, '_blank');
                }, url);
            });
            return;
        }
    }
    customAlert("Selecione ao menos 1 serviço");
}

function exportXlsx() {
    let rows = $('.table-list .check-input');
    for(i = 0; i < rows.length; i++){
        let row = rows[i];
        if($(row).prop('checked')){
            $("#form").attr('action', 'servicos/exportar').attr('method', 'post').submit();
            return;
        }
    }
    customAlert("Selecione ao menos 1 serviço");
}

function rebrandly(ids, callback){
    showProgress(3);
    let linkRequest = {
        destination: `http://sis-con.esy.es/mapa/servicos?${ids}`,
        domain: { fullName: "rebrand.ly" }
    }
    plusValueProgress();
    let requestHeaders = {
        "Content-Type": "application/json",
        "apikey": "248cf1cf408b4ff486fb4660355a355e"
    }
    plusValueProgress();
    $.ajax({
        url: "https://api.rebrandly.com/v1/links",
        type: "post",
        data: JSON.stringify(linkRequest),
        headers: requestHeaders,
        dataType: "json",
        success: (link) => {
            plusValueProgress();
            callback(`https://${link.shortUrl}`);
        },
        error: (error, data) => {
            plusValueProgress();
            callback(linkRequest.destination);
        }
    });
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
                        $("#col-" + sid).append("" +
                            "<div class=\"img-container\">\n" +
                            "     <img height='200px' src='"+ dataurl +"'/>" +
                            "     <div id='"+ randId +"' class=\"loding-img-container\">\n" +
                            "         <div style=\"display: table; margin: auto;\">\n" +
                            "           <div class='loading-spin fa-spin'></div>"+
                            "         </div>\n" +
                            "     </div>\n" +
                            "</div>");

                        endService(dataurl, sid, 1, null, randId);
                        $("#hidden-input-file").val(null);
                    }
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    });
});

function endService(b64, sid, status, observation, randId){
    console.log("img=" + b64);
    $.ajax({
        type: 'POST',
        url: 'api/end-service',
        data: {
            img: b64,
            id: sid,
            status: status,
            observation: observation
        },
        success: function (data) {
            console.log(data);
            switch (status) {
                case 1:{
                    $("#" + randId).remove();
                    $("#row-" + sid).attr('class', 'executed');
                    $("#row-" + sid + " > td > .btn-primary").attr('class', 'btn btn-primary btn-success').html("<i class='fas fa-plus'></i>");
                    $("#col-" + sid).css('background-color', '#d4e6d9');
                    break;
                }

                case 2:{
                    $("#row-" + sid).attr('class', 'not-executed');
                    $("#row-" + sid + " > td > .btn-danger").html("<i class='fas fa-times'></i>");
                    break;
                }

                case 3:{
                    $("#row-" + sid).attr('class', 'return');
                    $("#row-" + sid + " > td > .btn-warning").html("<i class='fas fa-undo'></i>");
                    break
                }
            }
        },
        error: function (ex) {
            console.log(ex);
            $("#" + randId + " > div").html("<b style='margin-top: 10px'>Erro ao fazer upload da imagem</b>");
        }
    });
}