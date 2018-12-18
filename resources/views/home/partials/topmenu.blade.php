<div id="{{ $idnav }}" class="navbar-collapse collapse partial" aria-expanded="false" style="height: 1px;margin-right:0px;" parent="#topMenuParent">
    <ul class="nav navbar-nav navbar-right">
        @if(Auth()->check())
            @include('home.partials.topmenu.check',['family'=>'menu.main'])
        @else
            @include('home.partials.topmenu.guest')
        @endif
    </ul>
</div>

