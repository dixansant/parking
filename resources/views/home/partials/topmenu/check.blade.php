@php
    /*$aa=\App\Util\Umenu::all_menues_new('main.menu');
    foreach ($aa as $k=>$it){
        echo ($it->title);
        //var_dump($it[0]);
    }*/
@endphp

@php($menues = \App\Util\Umenu::all_menues_new($family))
@include('layouts.menu', ['menues'=>$menues, 'classMainMenu'=>'dropdown-text'])



{{--
<ul class="nav navbar-nav navbar-right">
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Settings</a></li>
    <li><a href="#">Profile</a></li>
    <li><a href="#">Help</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
        </ul>
    </li>
</ul>
<form class="navbar-form navbar-right">
    <input type="text" class="form-control" placeholder="Search...">
</form>
--}}