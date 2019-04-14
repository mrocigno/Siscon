$(document).ready(function(){
    $("#file").change(function(e) {
        var file = e.originalEvent.srcElement.files[0];
        var extPermitidas = ['xls', 'xlsx'];
        if(typeof extPermitidas.find(function(ext){ return file.name.split('.').pop() === ext; }) === 'undefined'){
            alert("Selecione uma planilha");
            $("#file").val(null);
        }else{
            $("#form").submit();
            showLoading();
        }
    });

    $("#sltButton").click(function(){
        $("#file").val(null);
        $("#file").click();
    });

    $("#concat").change(function () {
        $(".labelN").toggleClass("hideClass showClassCell");
        $("#rowCompl").toggleClass("hideClass showClassRow");
        $("#colCompl").val("");
        $("#colN").val("");
    });

});

function clean(field){
    $(field).val("");
}

function getLatLng(callback) {
    var errors = 0;
    let address = $("#address");
    let n = $("#n");
    let neighborhood = $("#neighborhood");
    let city = $("#city");
    let uf = $("#uf");
    let zipCode = $("#zip_code");
    let lat = $("#lat");
    let lng = $("#lng");

    if($(address).val() === ""){
        errors++;
        $(address).addClass('is-invalid');
    }else{
        $(address).removeClass('is-invalid');
    }

    if($(n).val() === ""){
        errors++;
        $(n).addClass('is-invalid');
    }else{
        $(n).removeClass('is-invalid');
    }

    if($(city).val() === ""){
        errors++;
        $(city).addClass('is-invalid');
    }else{
        $(city).removeClass('is-invalid');
    }

    if($(uf).val() === ""){
        errors++;
        $(uf).addClass('is-invalid');
    }else{
        $(uf).removeClass('is-invalid');
    }

    if(errors > 0){
        return;
    }

    let strAddress = $(address).val() + ", " + n.val();
    let strNeighborhood = $(neighborhood).val();
    let strCity = $(city).val();
    let strUf = $(uf).val();

    console.log(strAddress);


    let url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAgBnb9DGepdpJunK2Dxe2YgMkjLbGv30I&address=';
    url += formatAddress(strAddress) + " " +
        (strNeighborhood === ""? "" : "- " + strNeighborhood) +
        strCity + " - " + strUf + ", Brasil";
    searchAddress(url, null, neighborhood, zipCode, lat, lng, callback);
}