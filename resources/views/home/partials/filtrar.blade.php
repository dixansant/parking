@php($filmenu = \App\Tipo::all())
<div style="min-width: 200px"></div>
<li class="dropdown-submenu">
    <a href="!{{ route('filtrar.alquiler',['tipo'=>'alquiler'],false) }}">Alquiler</a>
</li>
<li class="dropdown-submenu">
    <a href="!{{ route('filtrar.venta',['tipo'=>'venta'],false) }}">Venta</a>
</li>
<li class="divider">

</li>
@foreach($filmenu as $subm)
    <li class="dropdown-submenu">
        <a href="!{{ route('filtrar.tipo',['tipo'=>$subm->id],false) }}">{{$subm->nombre}}</a>
    </li>
    @endforeach
