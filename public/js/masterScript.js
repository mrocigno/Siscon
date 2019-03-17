var toggleVar = "col-md-12 col-md-10";

$(document).ready(function() {

    $("#menuBtn").click(function(){
        $("#menuDrawer").toggleClass("hideClass showClass");
        $("#headerCol").toggleClass(toggleVar);
        $("#iconMenu").toggleClass("fa-bars fa-arrow-left")
    });

    $("#btnNo").click(function () {
        closeBlackBackground();
    });

    $("a").click(function () {
        console.log("sdasd");
        showLoading();
    });
});

function showMenuOptions(){
    toggleVar = "col-md-10 col-md-8";
    $("#headerCol").attr("class", "col-md-10")
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
    $("#loading-holder").css("display", "none");
    $("#progress-holder").css("display", "none");
    $("#btnYes").unbind();
}