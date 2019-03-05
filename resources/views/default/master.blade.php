<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title> @yield('title') </title>
    @include('default.head')
     <script language="javascript" type="text/javascript">
      $(document).ready(function() {
        $("#menuBtn").click(function(){
          $("#menuDrawer").toggleClass("hideClass showClass");
          $("#headerCol").toggleClass("col-md-12 col-md-10");
          $("#iconMenu").toggleClass("fa-bars fa-arrow-left")
        });
      });
    </script>
  </head>
  <body>
    <div class="row" style="padding: 0px; margin: 0px;">
      <div id="menuDrawer" class="col-md-2 hideClass" style="padding: 0px; margin: 0px;">
        @include('default.drawer')
      </div>
      <div id="headerCol" class="col-md-12" style="padding: 0px; margin: 0px; padding-top: 60px; height: 100vh; overflow-y: scroll;">
        <header>
          <table>
            <tr>
              <td id="menuBtn">
                <i id="iconMenu" class="fas fa-bars"></i>
              </td>
              <td>
                  @yield('title')
              </td>
            </tr>
          </table>
        </header>
        @yield('content')
      </div>
    </div>
  </body>
</html>