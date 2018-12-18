@extends('layouts.partials')
@section('content_partial')

    <script class="partial">

        var ms='';
        @foreach($errors as $k=>$v)

                @foreach($v as $m)
            ms+='{!! $m !!}<br>';
        @endforeach
        @endforeach


        toastr.error(ms, '{{ __('Reset password failed...') }}')
        /*$('#formForgot')[0].reset();
        $('input:visible').focus()*/

        //alert($('#formForgot > input')[0])

    </script>

@endsection