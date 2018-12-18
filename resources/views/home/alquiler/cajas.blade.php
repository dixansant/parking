@foreach($cajas as $caja)

    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 conte">
        <div class="col-md-12 caja">
            <div class="col-md-12 imagen">
                <img src="@if('' === $caja->imagen) {{ asset('img/casa'.rand(0,9).'.jpg') }} @else {{ $caja->imagen }} @endif" width="100%">
                <div class="nombre">{{ $caja->nombre }}</div>
            </div>
            <div class="col-md-12 detalles">

                    <br>
                <b>Descripci&oacute;n:</b><div class="view-det" ><a href="?dialog={{route('ver.detalles',['alquiler'=>$caja->id],false)}}"><b>Ver detalles...</b></a></div><br>
                    {{ $caja->descripcion }}
            </div>
        </div>
    </div>
@endforeach



<style>
    .conte {
        padding-left: 5px;
    }

    .detalles {
        height: 100px;
        overflow: hidden;
        font-size: 12px;
    }


    .caja {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 0px;
    }

    .caja > DIV {
        margin: 0px;
        padding: 0px;
    }

    .nombre {
        position: absolute;
        top: 0px;
        color: #fff;

        padding: 10px;
        width: 100%;

        background: linear-gradient(to top, rgba(255,0,0,0), rgba(0,0,0,.9));
        font-size: 12px;
        text-shadow: 1px 1px 1px #000;
    }

    .imagen IMG {
        height: 180px;
    }

    .view-det {
        float: right;
        margin-top: -10px;
    }
</style>