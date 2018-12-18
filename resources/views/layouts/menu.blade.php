    @php($classMainMenu=$classMainMenu??'dropdown-main-menu')
    @php($level=[])
    @foreach($menues as $k=>$mnu)

        @php($next=isset($menues[$k+1])?$menues[$k+1]:(object)['parent'=>-1])

        @if($next->parent==$mnu->id)
            @php($level[]=$mnu->id)

            <li class="@if(count($level)>1) dropdown-submenu @else dropdown-main-menu {{$classMainMenu }} @endif">

                @switch($mnu->linkref)
                    @case('view')
                        @if (view()->exists($mnu->href))
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                                @include($mnu->href)
                            </a>

                        @else
                            <li><a>Missing view: {{$mnu->href}}</a></li>
                        @endif
                    @break
                    @default
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            {{ __($mnu->title) }}
                        </a>
                    @endswitch

                <ul class="dropdown-menu multi-level">

                    @else
                        @if($mnu->title=='-')
                            <li class="divider"></li>
                        @else
                            @switch($mnu->linkref)
                                @case('view')
                                @if (view()->exists($mnu->href))
                                    <li class="dropdown-menu-content">
                                        @include($mnu->href)
                                    </li>
                                @else
                                    <li><a>Missing view: {{$mnu->href}}</a></li>
                                @endif
                                @break
                                @default
                                    <li><a href="{{ \App\Util\Umenu::createLink($mnu) }}">{{ __($mnu->title) }}</a></li>
                            @endswitch
                        @endif

                        @if($next->parent!=$mnu->id && $next->parent!=$mnu->parent)
                            @while(count($level)>0 && $next->parent!=$level[count($level)-1] )
                                @php(array_pop($level))
                </ul>
        </li>
        @endwhile
        @endif

        @endif
    @endforeach


