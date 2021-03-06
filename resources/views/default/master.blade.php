<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title> @yield('title') </title>
    @include('default.head')
</head>
<body>
<div id="black-background" class="hideClass">

    <div id="alert-holder" class="center-form" style="display: none">
        <p id="alert-text">
            Você tem certeza?
        </p>
        <div>
            <input id="btnOk" type="button" class="btn btn-success" value="OK" style="width: 100%">
        </div>
    </div>

    <div id="msg-holder" class="center-form" style="display: none">
        <p class="msg-text">
            Você tem certeza?
        </p>
        <table class="max-size">
            <tr>
                <td><input id="btnNo" type="button" class="btn btn-danger" value="Não" style="width: 100%"></td>
                <td><input id="btnYes" type="button" class="btn btn-success" value="Sim" style="width: 100%"></td>
            </tr>
        </table>
    </div>

    <div id="input-holder" class="center-form" style="display: none">
        <p id="input-msg" class="msg-text">
            Você tem certeza?
        </p>
        <input class="form-control" id="input-value">
        <table class="max-size">
            <tr>
                <td><input id="btnCancel" type="button" class="btn btn-danger" value="Cancelar" style="width: 100%"></td>
                <td><input id="btnContinue" type="button" class="btn btn-success" value="Continuar" style="width: 100%"></td>
            </tr>
        </table>
    </div>

    <div id="loading-holder" class="center-form" style="display: none">
        @include('default.assets.load_spin')
    </div>

    <div id="progress-holder" class="center-form" style="display: none">
        <p class="msg-text">Carregando... <i style="float: right" class="fas fa-spin fa-spinner"></i></p>
        <div id="progress-conteiner" class="progress" style="width:100%">
            <div id="progress-value" class="progress-bar" role="progressbar" style="width:0%">
            </div>
        </div>
    </div>

</div>
<div class="row" style="padding: 0px; margin: 0px;">
    <div id="menuDrawer" class="showClass" style="width: 225px; float: left">
        <img src="@if(\Illuminate\Support\Facades\Cookie::get("logo") == "") http://sis-con.esy.es/public/img/logo.png @else {{ \Illuminate\Support\Facades\Cookie::get("logo") }} @endif" id="logo"/>
        @yield('drawer', View::make('default.drawer'))
    </div>
    <div id="headerCol" class="headerPlusDrawer" style="padding: 0px; margin: 0px; float: left">
        <div>
            <header>
                <table class="max-size" style="position: relative">
                    <tr>
                        <td id="menuBtn">
                            <i id="iconMenu" class="fas fa-arrow-left"></i>
                        </td>
                        <td>
                            @yield('title')
                        </td>
                        <td style="padding: 0">
                            <div id="header-user">
                                <i class="fas fa-user-circle"></i>
                                <div id="content-user">
                                    @include('default.user')
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </header>
        </div>
        <div style="height: calc(100vh - 60px); overflow-y: auto;">
            @yield('content')
        </div>
    </div>
    <div id="menuOptions" class="hideClass" style="padding: 0px; margin: 0px; width: 225px; float: left">
        @yield('menuOptions')
    </div>
</div>
</body>
</html>