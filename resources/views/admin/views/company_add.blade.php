@extends('admin.default')
@section('title')
    Adicionar empresa
@stop

@section('add')
    <center>
        <div class="center-form" style="margin-top: 20px;">
            <p class="@if(session()->has('message')) success @else errors @endif">
                {{ session()->get('message') }}
                {{ $errors->first('nome') }} 
                @if($errors->has('nome'))<br/>@endif
                {{ $errors->first('logo') }}
            </p>
            <form action="create" id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <th>
                            Nome:
                        </th>
                        <td>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Logo:
                        </th>
                        <td>
                            <input type="file" name="logo" class="form-control-file"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="../administrar-campos"><input type="button" name="cancel" class="btn btn-danger" value="Voltar" style="float: left"/></a>
                            <input type="button" onclick="submitYesNo('form')" name="ok" class="btn btn-success" value="Salvar" style="float: right"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
@stop