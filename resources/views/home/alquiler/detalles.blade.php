@extends('layouts.modal',[
    "id"=>'viewDetails',
    "title"=> __('Detalles...'),
    "open"=>isset($open)?$open:false,
    "reference"=>"/detalles/".$alquiler->id,
     "attr"=>'relative="1"',
     'footer'=>true
     ])

@section('content_modal')

    <div class="contentform">


        <div class="img_media">
            <img id="alquilerImg" src="{{ $alquiler->imagen }}"  />
        </div>

        <div class="temp_medias" class="form-group" style="padding: 10px; border-bottom: 1px dashed #ddd; width: 100%;">
            @foreach(\App\Media::where('handler',$alquiler->handler)->get() as $media)
                <div class="media">
                    <img src="{{ $media->media }}"/>
                </div>
            @endforeach

        </div>

        <div class="form-group">
            <label>{{ __('menu.name') }}</label>

            <p>{{ $alquiler->nombre }}</p>

        </div>

        <div class="form-group">
            <label>{{ __('menu.description') }}</label>

            <p>{{ $alquiler->descripcion }}</p>

        </div>

        <div class="leftcontact">
            <div class="form-group">
                <label>{{ __('menu.clasif') }}</label>

                <p>{{ $alquiler->clasif }}</p>

            </div>

            <div class="form-group">
                <label>{{ __('menu.address') }}</label>

                <p>{{ $alquiler->barrio }}</p>
            </div>

            <div class="form-group">
                <label>{{ __('menu.phone') }}</label>

                <p>{{ $alquiler->telefono }}</p>

            </div>


        </div>

        <div class="rightcontact">

            <div class="form-group">
                <label>{{ __('menu.type') }}</label>

                <p>{{ $alquiler->tipo }}</p>
            </div>

            <div class="form-group">
                <label>{{ __('menu.schedules') }}</label>
                <p>{{ $alquiler->horarios }}</p>

            </div>

        </div>

    </div>

    <script>
        $('.media IMG').click(function(){
            $('#alquilerImg').attr('src',$(this).attr('src'))
        })
    </script>

<style>

    .img_media {
        max-height: 400px;
        overflow: hidden;


    }
    .img_media IMG {
        width: 100%;
        margin: 0px auto;
    }

    .temp_medias .media {
        border: 1px solid #ddd;
        display: inline-block;
        width: 80px;
        height: 80px;

        cursor: pointer;

    }

    .media IMG {
        width: 100%;

    }
</style>

@endsection