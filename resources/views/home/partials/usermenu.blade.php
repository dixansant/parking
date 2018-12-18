<ul id="theUserMenu" class="nav navbar-right pull-right user-menu partial">
    @php($menues = \App\Util\Umenu::all_menues_new('menu.user'))
    @include('layouts.menu', ['menues'=>$menues,'classMainMenu'=>'main-menu'])
</ul>


