<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    @include('default.head')
  </head>
  <body>
    <center>
      <div class="center">
        <form action="login" method="POST" name="formLogin">
          <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
          <p class="errors">
                {{ $errors->first('email') }} 
                @if($errors->has('email'))<br/>@endif
                {{ $errors->first('password') }}
          </p>
          <table>
            <tr>
              <th>Email</th>
              <td><input type="email" name="email" class="form-control" value="{{ old('email') }}"/></td>
            </tr>
            <tr>
              <th>Senha</th>
              <td><input type="password" name="password" class="form-control"/></td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="button" name="forgot" style="float: left;" class="btn btn-warning" value="Esqueci a senha">
                <input type="submit" name="submit" style="float: right;" class="btn btn-success" value="Logar"></td>
            </tr>
          </table>
        </form>
      </div>
    </center>
  </body>
</html>