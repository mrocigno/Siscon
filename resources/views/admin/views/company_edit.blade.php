@extends('admin.default')
@section('title')
    Editar empresa
@stop

@section('edit')
    <center>
        <div class="center-form" style="margin-top: 20px;">
            <p class="@if(session()->has('message')) success @else errors @endif">
                {{ session()->get('message') }}
                {{ $errors->first('nome') }} 
                @if($errors->has('nome'))<br/>@endif
                {{ $errors->first('logo') }}
            </p>
            <form action="../update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <th>
                            Id:
                        </th>
                        <td>
                            <input type="text" name="id" class="form-control" readonly value="{!! $company->id !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nome:
                        </th>
                        <td>
                            <input type="text" name="name" class="form-control" value="{!! $company->name !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Logo:
                        </th>
                        <td>
                            <img src="{!! $company->logo !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>
                            <input type="file" name="logo" class="form-control-file"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="../lista"><input type="button" name="cancel" class="btn btn-danger" value="Voltar" style="float: left"/></a>
                            <input type="submit" name="ok" class="btn btn-success" value="Salvar" style="float: right"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
@stop