@extends('layouts.partials')
@section('content_partial')



        <a id="a_{{$menu->id}}" ref="{{$menu->id}}" data="{!! base64_encode(json_encode($menu)) !!}"
           class="item partial">{{$menu->title}}</a>

    <script class="partial">
        draganddrop.call($('A[ref="{{$menu->id}}"]'))

    </script>
@endsection