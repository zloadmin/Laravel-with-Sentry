<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Title</title>
        {{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
	</head>
	<body>
        <nav id="navbar" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a id="logo" href="/"><img src="/img/logo.png" alt=""></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="">
                            <a href="/companies/all"><span class="glyphicon glyphicon-list"></span> Клиенты</a>
                        </li>
                        <!-- Пункт меню для Партнера, Админа -->
                        <li class="">
                            <a href="/companies/payouts"><span class="glyphicon glyphicon-ok-circle"></span> Выплаты</a>
                        </li>


                        <li class="">
                            <a href="/histories/all"><span class="glyphicon glyphicon-time"></span> История

                            </a>
                        </li>


                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user"></span> Bill Gates <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/users/profile">Личный кабинет</a></li>


                            </ul>
                        </li>
                        <li><a href="/users/logout"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
        <!--Scripts-->
        {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
        {{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}
	</body>
</html>