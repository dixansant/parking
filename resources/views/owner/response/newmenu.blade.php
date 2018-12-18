@extends('layouts.partials')
@section('content_partial')


    <li id="li_{{$menu->id}}" parent="#item_{{$parent->id}}" class="partial li_ref_{{ $menu->id }}">
        <a id="a_{{$menu->id}}" ref="{{$menu->id}}" data="{!! base64_encode(json_encode($menu)) !!}"
           class="item">{{$menu->title}}</a>
        <ul id="item_{{$menu->id}}">
            <li class="first" dest="{{ $menu->id }}">
                <a class="item">&nbsp;</a>
            </li>
        </ul>
    </li>
    <li id="last_{{$menu->id}} partial li_ref_{{ $menu->id }}" class="last" dest="{{ $parent->id }}">
        <a class="item">&nbsp;</a>
    </li>


    {{--
    <li ref="{{$menu->id}}" parent="#item_0" class="partial li_ref_{{ $menu->id }}">
        <a class="item animated flash" data="{{ base64_encode(json_encode($menu)) }}" >{{ $menu->title }}</a>
        <ul id="item_{{$menu->id}}">
            <li class="first">
                <a class="item" >&nbsp;</a>
            </li>
        </ul>
    </li>
    <li class="last partial li_ref_{{ $menu->id }}" parent="#item_0">
        <a class="item">&nbsp;</a>
    </li>


    --}}
    <script class="partial">
        draganddrop.call($('.li_ref_{{$menu->id}} .item'))

    </script>
@endsection