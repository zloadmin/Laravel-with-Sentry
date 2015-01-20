@extends('layouts.default')

@section('content')

<div class="col-md-4 col-md-offset-4">
      <div class="panel panel-info">
        <div class="panel-heading">Регистрация</div>
        <div class="panel-body">
            {{ Form::open(array('url' => 'register')) }}
            @if($errors->any())
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </div>
            @endif
            <div class="form-group">
                {{ Form::label('fio', 'ФИО*') }}
                {{ Form::text('fio', '', array('class' => 'form-control', 'placeholder' => 'Фамилия Имя Отчество', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', 'Email адресс*') }}
                {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email адресс', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('phone', 'Телефон*') }}
                {{ Form::text('phone', '', array('class' => 'form-control', 'placeholder' => 'Телефон', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', 'Пароль*') }}
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Пароль', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('password2', 'Повторите пароль*') }}
                {{ Form::password('password2', array('class' => 'form-control', 'placeholder' => 'Повторите пароль', 'required' => 'required')) }}
            </div>
            <div class="form-group">
                {{ Form::label('managername', 'Имя и фамилия менеджера, который вас пригласил в систему:') }}
                {{ Form::text('managername', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
                {{ Form::submit('Регистрация', array('class' => 'btn btn-success')) }}
                {{ HTML::link('/', 'Отмена', array('class' => 'btn btn-danger')) }}
            </div>
            {{ Form::close() }}
        </div>
      </div>
</div>
@stop