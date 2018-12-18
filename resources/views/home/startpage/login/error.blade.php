@extends('layouts.partials')
@section('content_partial')

        <script class="partial">
            $('FORM')[0].reset();
            $('#email').addClass('is-invalid').focus()
            toastr.error('{{ _('The user or password are incorrect...')}}', '{{ __('Login Error!') }}')
        </script>

@endsection