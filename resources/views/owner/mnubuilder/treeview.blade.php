@foreach($menus as $family=> $menues)
    <ul id="ul_menu" class="treeview">

        <li><a class="item">{{ __($family) }}</a>
            <ul id="item_0">
                <li class="first" dest="0">
                    <a class="item">&nbsp;</a>
                </li>

                @foreach($menues as $k=>$mnu)

                    @php($next=isset($menues[$k+1])?$menues[$k+1]:(object)['parent'=>-1])

                    @if($next->parent==$mnu->id)
                        @php($level[]=$mnu->id)
                        <li id="li_{{$mnu->id}}">
                            <a id="a_{{$mnu->id}}" ref="{{$mnu->id}}" data="{!! base64_encode(json_encode($mnu)) !!}" class="item">{{$mnu->title}}</a>
                            <ul id="item_{{$mnu->id}}">
                                <li class="first" dest="{{ $mnu->id }}">
                                    <a class="item">&nbsp;</a>
                                </li>

                                @else

                                    <li id="li_{{$mnu->id}}">
                                        <a id="a_{{$mnu->id}}" ref="{{$mnu->id}}" data="{!! base64_encode(json_encode($mnu)) !!}"
                                           class="item">{{$mnu->title}}</a>
                                        <ul id="item_{{$mnu->id}}">
                                            <li class="first" dest="{{ $mnu->id }}">
                                                <a class="item">&nbsp;</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li 2 id="last_{{$mnu->id}}" class="last" dest="{{ $level[count($level)-1]??0 }}">
                                        <a class="item">&nbsp;</a>
                                    </li>
                                    @if($next->parent!=$mnu->id && $next->parent!=$mnu->parent)

                                        @while(count($level)>0 && $next->parent!=$level[count($level)-1] )
                                            @php($de=array_pop($level))
                            </ul>
                        <li id="last_{{$de}}" class="last" dest="{{ $level[count($level)-1]??0 }}">
                            <a class="item">&nbsp;</a>
                        </li>
                        </li>
                        @endwhile
                    @endif

                    @endif

                @endforeach


            </ul>
        </li>
    </ul>
@endforeach