<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title> @yield('title') </title>
    @include('default.head')
    <script language="javascript" type="text/javascript"
            src="{!! URL::asset('/public/js/masterScript.js') !!}"></script>
</head>
<body>
<div id="black-background" class="hideClass">
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

    <div id="loading-holder" class="center-form" style="display: none">
        <div id="loading-spin" class="fa-spin">

        </div>
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
    <div id="menuDrawer" class="col-md-2 hideClass">
        @include('default.drawer')
    </div>
    <div id="headerCol" class="col-md-12" style="padding: 0px; margin: 0px;">
        <div>
            <header>
                <table class="max-size">
                    <tr>
                        <td id="menuBtn">
                            <i id="iconMenu" class="fas fa-bars"></i>
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
    <div id="menuOptions" class="col-md-2 hideClass" style="padding: 0px; margin: 0px;">
        @yield('menuOptions')
    </div>
</div>
</body>
</html>