@extends('admin.default')
@section('title')
    Adicionar solicitante
@stop

@section('add')
    <center>
        <div class="center-form" style="margin-top: 20px;">
            <span class="@if(session()->has('message')) success @else errors @endif">
                {{ session()->get('message') }}
                {{ $errors->first('nome') }} 
                @if($errors->has('nome'))<br/>@endif
                {{ $errors->first('email') }} 
                @if($errors->has('email'))<br/>@endif
                {{ $errors->first('password') }}
                @if($errors->has('password'))<br/>@endif
                {{ $errors->first('empresa') }}
                @if($errors->has('empresa'))<br/>@endif
                {{ $errors->first('tipoDeUsuário') }}
                @if($errors->has('tipoDeUsuário'))<br/>@endif
            </span>
            <form action="create" id="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr @if(Auth::user()->user_type_id != 1) class="hideClass" @endif>
                        <th>
                            Empresa:
                        </th>
                        <td>
                            <select name="company" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($companies as $company)
                                    <option value="{!! $company->id !!}"
                                            @if(Auth::user()->user_type_id != 1)
                                                @if($company->id == Auth::user()->company_id)
                                                    selected
                                                @endif
                                            @else
                                                @if($company->id == old('company'))
                                                    selected
                                                @endif
                                            @endif
                                    >{!! $company->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
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
                            Email:
                        </th>
                        <td>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipo de usuário:
                        </th>
                        <td>
                            <select name="userType" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($userType as $type)
                                    <option value="{!! $type->id !!}" @if($type->id == old('userType')) selected @endif>{!! $type->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0px">
                            <table class="max-size">
                                <tr>
                                    <th>
                                        Senha:
                                    </th>
                                    <th>
                                        Confirme a senha:
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="password" name="password" class="form-control" value="{{ old('password') }}"/>
                                    </td>
                                    <td>
                                        <input type="password" name="password_confirmation" class="form-control"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a href="../administrar-campos"><input type="button" name="cancel" class="btn btn-danger" value="Voltar" style="float: left"/></a>
                                        <input type="button" onclick="submitYesNo('form')" name="ok" class="btn btn-success" value="Salvar" style="float: right"/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
@stop