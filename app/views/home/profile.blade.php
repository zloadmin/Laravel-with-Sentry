@extends('layouts.default')

@section('content')
    <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-info">
            <div class="panel-heading">Информация о пользователе</div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'profile')) }}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </div>
                @endif
                 @if(Session::has('status') == 'ok_update')
                    <div class="alert alert-success"">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <li class="error">Сохранено</li>
                    </div>
                @elseif(Session::has('status') == 'errror_update')
                   <div class="alert alert-danger">
                       <a href="#" class="close" data-dismiss="alert">&times;</a>
                       <li class="error">Ошибка</li>
                   </div>
                @endif
                <div class="form-group">
                    {{ Form::label('fio', 'ФИО*') }}
                    {{ Form::text('fio', Sentry::getUser()->fio, array('class' => 'form-control', 'placeholder' => 'Фамилия Имя Отчество', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email адресс*') }}
                    {{ Form::text('email', Sentry::getUser()->email, array('class' => 'form-control', 'placeholder' => 'Email адресс', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('phone', 'Телефон*') }}
                    {{ Form::text('phone', Sentry::getUser()->phone, array('class' => 'form-control', 'placeholder' => 'Телефон', 'required' => 'required')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Адрес доставки') }}
                    {{ Form::textarea('address', Sentry::getUser()->address, array('class' => 'form-control', 'placeholder' => 'Адрес доставки', 'rows' => '3')) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Сохранить', array('class' => 'btn btn-success')) }}
                </div>
                {{ Form::close() }}
            </div>
          </div>
    </div>
@stop