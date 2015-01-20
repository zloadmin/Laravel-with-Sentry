@extends('layouts.default')

@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">Востановить пароль</div>
        <div class="panel-body">
            {{ Form::open(array('url' => 'reset')) }}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <ul class="errorsul">
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </ul>
                    </div>
                @endif
                @if(Session::has('send'))
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <ul class="errorsul">
                        <li class="error">{{ Session::get('send') }}</li>
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    {{ Form::label('email', 'Email адресс') }}
                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email адресс', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Востановить', array('class' => 'btn btn-success')) }}
                    {{ HTML::link('/login', 'Отмена', array('class' => 'btn btn-danger')) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop