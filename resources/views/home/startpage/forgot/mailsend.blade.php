@extends('layouts.partials')
@section('content_partial')

        <script class="partial">
            toastr.warning('{{ _('Send Succ')}}', '{{ __('Forgot!') }}')
            goHome();


            //$('#passForgot').parents('.modal').prop('target', $('<a class="close"></a>'));
            //$('#passForgot').modal('hide');
        </script>

@endsection