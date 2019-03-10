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

function closeBlackBackground(){
    $("#black-background").toggleClass("hideClass showClass");
    $("#msg-holder").css("display", "none");
    $("#loading-holder").css("display", "none");
    $("#btnYes").unbind();
}