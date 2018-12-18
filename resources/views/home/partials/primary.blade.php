<div id="primaryMenu" class="partial">
    <ul class="nav navbar-nav nav-left">
        @php($menues = \App\Util\Umenu::all_menues_new('menu.primary.left'))
        @include('layouts.menu', ['menues'=>$menues, 'classMainMenu'=>'dropdown-text'])
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @php($menues = \App\Util\Umenu::all_menues_new('menu.primary.right'))
        @include('layouts.menu', ['menues'=>$menues, 'classMainMenu'=>'dropdown-text'])
    </ul>
</div>

