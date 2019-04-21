@extends('admin.default')
@section('title')
    Editar polo
@stop

@section('add')
    <center>
        <div class="center-form" style="margin-top: 20px;">
            <p class="@if(session()->has('message')) success @else errors @endif">
                {{ session()->get('message') }}
                {{ $errors->first('nome') }} 
            </p>
            <form action="../update" id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <th>
                            Id:
                        </th>
                        <td>
                            <input type="text" name="id" class="form-control" readonly value="{!! $polo->id !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nome:
                        </th>
                        <td>
                            <input type="text" name="name" class="form-control" value="{!! $polo->polo !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="../lista"><input type="button" name="cancel" class="btn btn-danger" value="Voltar" style="float: left"/></a>
                            <input type="button" onclick="submitYesNo('form')" name="ok" class="btn btn-success" value="Salvar" style="float: right"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
@stop