function setValue(value, to){
    $("#" + to).val(value);
}

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
        url: 'http://localhost/Siscon/distribuir/get-table',
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