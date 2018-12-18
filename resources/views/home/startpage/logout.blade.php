@extends('layouts.partials')
@section('content_partial')

    <script class="partial">
        // eliminar todas las scenas execto


        $('.scene[reference]').each(function () {
            ref= $(this).attr('reference');
            if (ref != '/home' && ref != '/home/logout' && ref != 'errortemplate')
                $(this).remove();
        });

        location.href='#/home'

        {{--
        clearScenes('{{$ref}}');


        @if($auth)
            toastr.success('{{ _('You have been disconect!....')}}', '{{ __('User Logout!') }}')
        @else
            toastr.warning('{{ _('You have already disconnected before!....')}}', '{{ __('User Logout!') }}')
        @endif
        --}}

        toastr.success('{{ _('You have been disconect!....')}}', '{{ __('User Logout!') }}')
        //alert('desconectando .....')
    </script>

    @include('home.partials.topmenu', ['idnav'=>'navbar'])
    @include('home.partials.usermenu')
    @include('home.partials.primary')

@endsection