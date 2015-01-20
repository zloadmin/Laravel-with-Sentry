<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
		<title>Title</title>
		{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css') }}
		{{ HTML::style('/css/main.css') }}
	</head>
	<body>
	    @include('layouts.navbar')

        <div class="container">
            <div class="starter-template">
                @yield('content')
            </div>
        </div>
        <!--Scripts-->
        {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}
        {{ HTML::script('/js/jquery.maskedinput.min.js') }}
        {{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js') }}


        {{ HTML::script('/js/functions.js') }}
	</body>
</html>