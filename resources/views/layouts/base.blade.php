<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>





    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/logo.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" />
    <title>{{ \App\Appvar::where('name','appname')->first()->value }}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <link href="{{ asset('css/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/jquery-ui.theme.min.css')}}" rel="stylesheet" />


    <link href="{{ asset('plugins/alertly/jquery.alertly.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/required/required.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/password-strength/password.min.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/css/dataTables.jqueryui.css')}}" rel="stylesheet">
    <link href="{{ asset('plugins/animatecss/animate.min.css')}}" rel="stylesheet">

    <!-- Fonts and Icons -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <link href="{{ asset('css/themify-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />



</head>
<body>

   @yield('content')


</body>

{{--
    <script src="{{ asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    --}}
    <script src="{{ asset('js/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-ui.min.js')}}" type="text/javascript"></script>

    <script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/alertly/jquery.alertly.min.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('plugins/required/required.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('plugins/validator/validator.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('plugins/validator/'.app()->getLocale().'.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('plugins/password-strength/password.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('plugins/animatecss/animate.min.js') }}" type="text/javascript" ></script>

    <script type="text/javascript" src="{{ asset('js/fnts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
   @yield('javascript')

</script>


</html>
