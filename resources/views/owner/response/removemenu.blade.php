@extends('layouts.partials')
@section('content_partial')
    <script class="partial">
        $('#li_{{$menu->id}}').next().remove()
        $('#li_{{$menu->id}}').remove()
    </script>
@endsection