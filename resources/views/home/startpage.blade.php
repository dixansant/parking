@php($filtro=$filtro??'Home')
<div id="startPage{{$filtro}}" class="@isset($partial) partial @endisset">
    <div class="row">
        <div class="col-md-12"
             style="margin-right: -20px ; border: 1px solid #ddd; padding: 10px 0px 4px; border-left: 0px; border-right: 0px;  ">
            <div style="float: right">
                <div style="float: left; padding: 5px 10px 0px;">{{ __('Página: ') }}</div>
                <div style="float: left">
                    @include('home.alquiler.paginacion',['items'=>$items])
                </div>
            </div>
            <div style="padding: 5px 10px;">
                @foreach($menu as $k=>$mnu)
                <b>{{ $k }} &gt;</b>
                    @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        @include('home.alquiler.cajas')
    </div>
</div>





