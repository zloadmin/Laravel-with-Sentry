<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="collapse navbar-collapse">

        <ul class="nav navbar-nav navbar-left">
            <li><a href="/"><span class="glyphicon glyphicon-home"></span> Главная</a></li>
            @if(Sentry::getUser())
            <li><a href="#"><span class="glyphicon glyphicon-list"></span> Клиенты</a></li>
            @endif
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if(Sentry::getUser())
            <li><a href="/profile"><span class="glyphicon glyphicon-user"></span> {{ Sentry::getUser()->fio }}</a></li>
            <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
            @else
            <li><a href="/register"><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>
            <li><a href="/login"><span class="glyphicon glyphicon-log-in"></span> Вход</a></li>
            @endif
        </ul>
        </div>
    </div>
</div>