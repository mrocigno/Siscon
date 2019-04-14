var toggleVar = "headerPlusDrawer headerMax";

$(document).ready(function() {

    $("#menuBtn").click(function(){
        $("#menuDrawer").toggleClass("showClass hideClass");
        $("#headerCol").toggleClass(toggleVar);
        $("#iconMenu").toggleClass("fa-arrow-left fa-bars");
        document.cookie = "show=true"
    });

    $("#btnNo").click(function () {
        closeBlackBackground();
    });

    $("#btnOk").click(function () {
        closeBlackBackground();
    });

    $("a").click(function () {
        showLoading();
    });
});

function showMenuOptions(){
    toggleVar = "headerPlusDrawerAndOptions headerPlusDrawer";
    $("#headerCol").attr("class", "headerPlusDrawerAndOptions")
    $("#menuOptions").toggleClass("hideClass showClass");
}

function submitYesNo(form){
    confirmBox(function () {
        $("#" + form).submit();
        showLoading();
    });
}

function confirmBox(callback){
    $("#black-background").toggleClass("hideClass showClass");
    $("#msg-holder").css("display", "table");
    $("#btnYes").click(function () {
        closeBlackBackground();
        callback();
    });
}

function customAlert(msg){
    $("#black-background").toggleClass("hideClass showClass");
    $("#alert-holder").css("display", "table");
    $("#alert-text").html(msg);
}

function showLoading(){
    $("#black-background").toggleClass("hideClass showClass");
    $("#loading-holder").css("display", "table");
}

var progressMax;
var progressValue;

function showProgress(max){
    progressMax = max;
    progressValue = 0;
    $("#black-background").toggleClass("hideClass showClass");
    $("#progress-holder").css("display", "table");
}

function plusValueProgress(){
    progressValue++;
    let percent = (progressValue * 100) / progressMax;
    $("#progress-value").css('width', percent + "%");
    if(percent === 100){
        closeBlackBackground();
    }
}

function closeBlackBackground(){
    progressMax = 0;
    progressValue = 0;
    $("#black-background").toggleClass("hideClass showClass");
    $("#msg-holder").css("display", "none");
    $("#alert-holder").css("display", "none");
    $("#loading-holder").css("display", "none");
    $("#progress-holder").css("display", "none");
    $("#btnYes").unbind();
}

function selectAll(chkMain) {
    $('.table-list > tbody > tr > td > .check-input').prop('checked', $(chkMain).is(":checked"));
}