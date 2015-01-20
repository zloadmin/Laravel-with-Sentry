@extends('layouts.default')

@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-info">
        <div class="panel-heading">Изменение пароля</div>
        <div class="panel-body">
            {{ Form::open() }}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <ul class="errorsul">
                            {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                        </ul>
                    </div>
                @endif
                {{ Session::has('error') }}
                <div class="form-group">
                    {{ Form::label('email', 'Новый пароль') }}
                    {{ Form::password('password',  array('class' => 'form-control', 'placeholder' => 'Новый пароль', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Повторите пароль') }}
                    {{ Form::password('password2', array('class' => 'form-control', 'placeholder' => 'Повторите пароль', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Сохранить пароль', array('class' => 'btn btn-success')) }}
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>
@stop