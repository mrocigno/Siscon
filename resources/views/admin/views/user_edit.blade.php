@extends('admin.default')
@section('title')
    Editar usuário
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
                {{ $errors->first('senhaAtual') }}
                @if($errors->has('senhaAtual'))<br/>@endif
            </span>
            <form action="../update" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <table>
                    <tr>
                        <th>
                            Id:
                        </th>
                        <td>
                            <input type="text" name="id" class="form-control" readonly value="{!! $user->id !!}"/>
                        </td>
                    </tr>
                    <tr @if(Auth::user()->user_type_id != 1) class="hideClass" @endif>
                        <th>
                            Empresa:
                        </th>
                        <td>
                            <select name="company" class="form-control">
                                <option value="">-- Selecione --</option>
                                @foreach($companies as $company)
                                    <option value="{!! $company->id !!}"
                                        @if($company->id == $user->company_id)
                                            selected
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
                            <input type="text" name="name" class="form-control" value="{!! $user->name !!}"/>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Email:
                        </th>
                        <td>
                            <input type="email" name="email" class="form-control" value="{!! $user->email !!}"/>
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
                                    <option value="{!! $type->id !!}" @if($type->id == $user->user_type_id) selected @endif>{!! $type->name !!}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" style="text-align: center">
                            --------------- Alterar senha ---------------
                        </th>
                    </tr>
                    <tr>
                        <th>
                            Senha atual:
                        </th>
                        <td>
                            <input type="password" name="now_password" class="form-control" value="{{ old('now_password') }}"/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0px">
                            <table class="max-size">
                                <tr>
                                    <th>
                                        Nova senha:
                                    </th>
                                    <th>
                                        Confirme a nova senha:
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
                                        <a href="../lista"><input type="button" name="cancel" class="btn btn-danger" value="Voltar" style="float: left"/></a>
                                        <input type="submit" name="ok" class="btn btn-success" value="Salvar" style="float: right"/>
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