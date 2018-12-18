@extends('layouts.partials')
@section('content_partial')

        <script class="partial">
            toastr.success('{{ _('Register Complete...')}}', '{{ __('Registration') }}')
            //$('#formRegister').prop('target',true).modal('hide')
            //goHome();


            //$('#passForgot').parents('.modal').prop('target', $('<a class="close"></a>'));
            //$('#passForgot').modal('hide');
        </script>

        @include('home.startpage')
@endsection

