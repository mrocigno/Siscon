@extends('default.master')
@section('title')
Importar serviços
@stop

@section('stylecustom')
<link rel="stylesheet" href="{{ URL::asset('public/css/importStyle.css') }}"/>
<script type="text/javascript" src="{{ URL::asset('public/js/importScript.js') }}"></script>
@stop

@section('content')
    <div style="padding: 20px">

        <div class="center-form">
            <form>
                <table>
                    <tr>
                        <th>Nome da remessa:</th>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>
                            Solicitante:<br/>
                            <select class="form-control" name="applicant">
                                <option value=""></option>
                            </select>
                            <br/><br/>
                            <table>
                                <tr>
                                    <th colspan="2">Ou referente a coluna:</th>
                                </tr>
                                <tr>
                                @for ($i = 0; $i < count($titles); $i++)
                                    <input type="radio" name="colApplicant"  value="{!! $titles[$i] !!}"/>
                                    <label for="colApplicant">{!! $titles[$i] !!}</label>
                                    @if($i%2 > 0)
                                        </tr>
                                        <tr>
                                    @endif
                                @endfor
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="center-form max-size">
            <table class="table-list">
                <tr class="head">
                    @foreach($titles as $title)
                        <th>{!! $title !!}</th>
                    @endforeach
                </tr>
                @foreach($rows as $row)
                    <tr>
                        @foreach($row as $column)
                            <td>{!! $column !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop