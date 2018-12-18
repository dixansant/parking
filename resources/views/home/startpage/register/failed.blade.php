@extends('layouts.partials')
@section('content_partial')
        <script class="partial">
            var ms='';
            @foreach($errors as $k=>$v)
                    @foreach($v as $m)
                ms += '{!! $m !!}<br>';
            @endforeach
            @endforeach
            toastr.error(ms, '{{ __('Registration error...') }}')
        </script>

@endsection