$(document).ready(function () {
    let readOnly = true;

    $("#edit").click(function () {
        readOnly = !readOnly;
        $('#identifier').prop('readonly', readOnly);
        $('#date_received').prop('readonly', readOnly);
        $('#service_description').prop('readonly', readOnly);
        $('#address').prop('readonly', readOnly);
        $('#n').prop('readonly', readOnly);
        $('#neighborhood').prop('readonly', readOnly);
        $('#city').prop('readonly', readOnly);
        $('#uf').prop('readonly', readOnly);
        $('#lat').prop('readonly', readOnly);
        $('#lng').prop('readonly', readOnly);

        $("#applicant_id").attr('readonly', readOnly);
        $("#polo_id").attr('readonly', readOnly);
        $("#service_type_id").attr('readonly', readOnly);

        if($("#status_id").val() > 2){
            $("#user_id").attr('readonly', readOnly);
            $("#distributed_date").attr('readonly', readOnly);
        }

        $("#save").toggleClass('hideClass showClass')
        $(this).toggleClass('btn-warning btn-danger');
        if($(this).hasClass('btn-warning')){
            $(this).val('Editar');
        } else {
            $(this).val('Cancelar');
        }
    });

    $("#address").change(function () {
        $("#neighborhood").val("");
        $("#lat").val("");
        $("#lng").val("");
        $("#addressEdt").val("true");
    })

    $("#back").click(function () {
        window.location = $("#return").val();
    })
});


function addLatLng(sid) {
    showProgress(1);
    getLatLng(function () {
        $("#map_img").parent().attr('href', 'https://www.google.com.br/maps/place/'+ $("#lat").val() +','+ $("#lng").val());
        $("#map_img").attr('src', 'https://maps.googleapis.com/maps/api/staticmap?zoom=16&size=600x300&maptype=roadmap&markers=color:red%7Clabel:C%7C'+ $("#lat").val() +','+ $("#lng").val() +'&key=AIzaSyDhd1XSpoJ1YlosDmycLN4KfeL3LbvqXGE');
        $.ajax({
            type: 'POST',
            url: '../api/save-address',
            data: {
                sid: sid,
                lat: $("#lat").val(),
                lng: $("#lng").val(),
                neighborhood: $("#neighborhood").val()
            },
            success: function (data) {
                console.log(data);
            },
            error: function (data) {

            }
        });
    });
}