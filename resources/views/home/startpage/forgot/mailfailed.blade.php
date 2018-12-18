@extends('layouts.partials')
@section('content_partial')

        <script class="partial">
            toastr.error('{{ _('Mail not found...')}}', '{{ __('Forgot!') }}')
            $('#formForgot')[0].reset();
            $('input:visible').focus()

            //alert($('#formForgot > input')[0])

        </script>

@endsection