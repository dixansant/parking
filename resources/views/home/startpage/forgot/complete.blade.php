@extends('layouts.partials')
@section('content_partial')
        <script class="partial">
            toastr.success('{{ _('Change successfully...')}}', '{{ __('Reset Password') }}')
        </script>

        @include('home.startpage')
@endsection

