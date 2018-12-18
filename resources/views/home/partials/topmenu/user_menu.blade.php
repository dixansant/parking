@if(Auth()->check())
    <p>LOGUED OK!!!</p>
@else
    <p>PLEASE, LOGIN</p>
@endif
