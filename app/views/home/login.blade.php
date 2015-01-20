@extends('layouts.default')

@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">Вход</div>
        <div class="panel-body">
            {{ Form::open(array('url' => 'login')) }}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <ul class="errorsul">
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    {{ Form::label('email', 'Email адресс') }}
                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email адресс', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Пароль') }}
                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Пароль', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Войти', array('class' => 'btn btn-success')) }}
                    {{ HTML::link('/', 'Отмена', array('class' => 'btn btn-danger')) }}
                </div>
                <div class="form-group">
                    {{ HTML::link('/reset', 'Востановить пароль') }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop