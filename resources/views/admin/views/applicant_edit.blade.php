@extends('admin.default')
@section('title')
    Editar solicitante
@stop

@section('add')
    <center>
        <div class="center-form" style="margin-top: 20px;">
            <p class="@if(session()->has('message')) success @else errors @endif">
                {{ session()->get('message') }}
                {{ $errors->first('nome') }} 
                @if($errors->has('nome'))<br/>@endif
                {{ $errors->first('email') }} 
                @if($errors->has('email'))<br/>@endif
                {{ $errors->first('telefone') }} 
                @if($errors->has('telefone'))<br/>@endif
            </p>
            <form action="../update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <th>
                            Id:
                        </th>
                        <td>
                            <input type="text" name="id" class="form-control" readonly value="{!! $applicant->id !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nome:
                        </th>
                        <td>
                            <input type="text" name="name" class="form-control" value="{!! $applicant->name !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Email:
                        </th>
                        <td>
                            <input type="email" name="email" class="form-control" value="{!! $applicant->email !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Telefone:
                        </th>
                        <td>
                            <input type="text" name="telefone" class="form-control" value="{!! $applicant->telefone !!}"/>
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