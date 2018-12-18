@php
    $title_error = isset($title_error)?$title_error:'Error';
    $desc_error = isset($desc_error)?$desc_error:'Error at retrieve information on url';
    $type_error = isset($type_error)?$type_error:'error404';
    $ref = isset($ref)?$ref:'';
    $homepath = $homepath??'/'
@endphp
@extends('layouts.scene')
@section('content_scene2')
    <div class="errorpage">
        <div class="col-md-12 center-all" style="width: 100%; height: 100%;">
            <div>

                <h1 class="text-uppercase">{{__($title_error)}}</h1>


                <h2>{{ __($desc_error) }}</h2>
                <span style="text-align: left">

                    @isset($details)
                        {{ __($details) }}: <u class="link">{{ $ref }}</u> {{ __('errors.'.$type_error) }}
                    @endisset


                        @isset($description)
                            <div style="max-width: 400px">
                                {{ __($description) }}
                            </div>
                        @endisset




        </span>
                <br><br>
                <a class="btn btn-primary" href="{{ $homepath }}"><b>{{ __('errors.homepage') }}</b></a>
            </div>
        </div>
    </div>

@endsection