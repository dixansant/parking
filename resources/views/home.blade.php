@extends('layouts.base')
@section('content')

    @include('home.startpage.loading')

    <!-- Static navbar -->

    <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px; border-bottom:0px ">
        <div class="container">


            @include('home.partials.usermenu')



            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="#"><img style="position: absolute; margin-top: -10px" src="{{ asset('img/logo.png') }}"></a>


            </div>


                @include('home.partials.topmenu', ['idnav'=>'navbar'])



        </div>

    </nav>
    <nav class="navbar navbar-default navbar-static-top" style="border-bottom:1px solid #c0e18b; z-index: 999 ">
        <div class="container">
        @include('home.partials.primary')
        </div>
    </nav>



    <div id="zone_scenes" class="container">

        <div id="scenes">
            <div id="mainScene" class="scene partial" reference="/home" parent="#scenes" style="display:none">
                @php
                    $info=[
                        'cajas'=>\App\Alquiler::orderby('id','desc')->take(12)->get(),
                        'items'=>\App\Alquiler::all()->count(),
                        'menu' => [
                            'Inicio' => '#'
                        ],
                        'filtro'=>'Home'

                    ];
                @endphp
                @include('home.startpage',$info)
            </div>
        </div>

    </div> <!-- /container -->

    <footer class="footer">
        <div class="container">
            Mipuntoperfecto.com Copyright 2018 Mi Compañia , Todos los derechos reservados.
            <p class="text-muted fs-12">Contactos: telefonos 2222 2221 y 2222 2222, email: admin@mipuntoperfecto.com .</p>
        </div>
    </footer>


    {{-- escena para clonar cuando expiran otras --}}
    <div id="hide_zone" class="hidden">
        @php
            $ref = 'errortemplate';
            $title_error = 'Expired';
            $type_error = 'error600';
            $details = 'View at';
            $no_js = true;
        @endphp
        @include('errors.json')

        <iframe id="uploadcontent" name="uploadcontent">

        </iframe>
    </div>



    <script>

        base_path = '{{url()->current()}}';
                {{-- confirms para las alertas del sistema --}}
        var validations = {};
        var querys = {};


        var confirms = {
            'logout': {
                'title': '',
                'content': '{{ __('You want logout now? ')}}'
            },
            'delres': {
                'title': '{!! __('Remove Resource') !!}',
                'content': '{!! __('You want remove this resource<br> from your team? ')  !!}'
            },

        }

        var alerts = {
            'buylater': {
                'title': '{!! __('app.buylater_title') !!} ',
                'content': `{!!  __('app.buylater_content') !!}`
            }

        }

        function getconfirm(uri) {
            ret = (confirms[uri] != null)
                ? confirms[uri]
                : {
                    'title': '',
                    'content': '{{ __('Are you sure?')}}'
                }
            return ret;
        }




    </script>
    <style>
        .footer {
            background: #eee;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 20px 0px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
@endsection
