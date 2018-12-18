@extends('layouts.scene')
@section('content_scene')

    <form id="formNuevoAlquiler" action="{{ route('alquiler.enviar',[],false) }}">

        <input id="maxFiles"  name="maxFiles"  required="required" style="position: absolute; left: -2000px; visibility: hidden" value="{{ $alquiler->nombre }}">
        <input id="imagen"  name="imagen" required="required" style="position: absolute; left: -2000px; visibility: hidden" value="{{ $alquiler->imagen }}">
        <input id="id"  name="id" required="required" style="position: absolute; left: -2000px; visibility: hidden" value="{{ $alquiler->id }}">
        <h1>{{ $title }}</h1>

        <div class="contentform">


            <div class="form-group">
                <p>{{ __('menu.name') }}</p>

                <input type="text" name="nombre" id="nombre" required="required" value="{{ $alquiler->nombre }}"/>

            </div>

            <div class="form-group">
                <p>{{ __('menu.description') }}</p>

                <textarea id="descripcion" name="descripcion" required="required">{{ $alquiler->descripcion }}</textarea>

            </div>

            <div class="leftcontact">
                <div class="form-group">
                    <p>{{ __('menu.clasif') }}</p>

                    <select type="text" name="clasif" id="clasif" >
                        <option value="Alquiler" @if($alquiler->clasif == "Alquiler") selected @endif>Alquiler</option>
                        <option value="Venta" @if($alquiler->clasif == "Venta") selected @endif>Venta</option>
                    </select>

                </div>

                <div class="form-group">
                    <p>{{ __('menu.address') }}</p>

                    <input type="text" name="address" id="address" required="required" value="{{ $alquiler->barrio }}" />
                </div>

                <div class="form-group">
                    <p>{{ __('menu.phone') }}</p>

                    <input type="text" name="phone" id="phone" required="required" value="{{ $alquiler->telefono }}" />

                </div>



            </div>

            <div class="rightcontact">

                <div class="form-group">
                    <p>{{ __('menu.type') }}</p>

                    <select type="text" name="type" id="type" >
                        @foreach(\App\Tipo::all() as $tipo)
                        <option value="{{ $tipo->nombre }}" @if($tipo->nombre==$alquiler->tipo) selected @endif>{{ $tipo->nombre }}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <p>{{ __('menu.schedules') }}</p>
                    <input type="text" name="schedules" id="schedules" value="{{ $alquiler->horarios }}" />

                </div>


                <div class="form-group" id="cloneMedia" action="{{ route('crear.media') }}" >
                    @csrf
                    <input type="hidden" id="handler" name="handler" value="{{ $alquiler->handler }}" />
                    <p>{{ __('menu.media') }}</p>
                    <input type="file" name="media" id="media" onchange="cloneForm('#cloneMedia')" />

                </div>

            </div>
            <div id="temp_medias" class="form-group" style="border-top: 1px  dashed #ccc; ">
                @foreach(\App\Media::where('handler',$alquiler->handler)->get() as $media)
                    <div imagen="{{ $media->media }}" class="media @if($media->media == $alquiler->imagen) selected @endif"><img src="{{ $media->media }}" /></div>
                @endforeach

            </div>
        </div>
        <button type="submit" class="bouton-contact">Send</button>

    </form>


    <script>

        $('#formNuevoAlquiler').validator();

        $(document).on('click','.media',function(){
            $('#imagen').val($(this).attr('imagen'))
            $('.media.selected').removeClass('selected');
            $(this).addClass('selected');
            alert($(this).attr('imagen'))
        })

        function cloneForm(w){


            $clone = $(w).clone(true);
            $('#newFF').remove();
            $newForm= $('<form id="newFF" name="newFF" enctype="multipart/form-data" method="post" > ');
            $newForm.attr({
                action : $(w).attr('action'),
                target: 'uploadcontent'
            }).append($clone);

            $('#hide_zone').append($newForm);
            $newForm.submit();
            $(w).find('input:file').val('');

        }

        function acceptMedia(w,name,dest){
            if(w) {
                $('#temp_medias').append('<div imagen="'+dest+'" class="media"><img src="'+dest+'" /></div>')
                $('#maxFiles').val($('.media').length>0?'ok':'')
                if ($('#imagen').val().trim()=='') {
                    //alert("--->"+dest)
                    $('#imagen').val(dest)
                    $('.media').addClass('selected');
                }
            }


        }
    </script>
    <style>

        .media {
            border: 1px solid #ddd;
            float: left;
            width: 80px;
            height: 80px;
            margin: 20px 10px 0px 0px !important;
            cursor: pointer;
        }

        .media.selected {
            border: 2px solid #f00;
        }

        .media IMG {
            width: 100%;
            height: 100%;
        }

        #formNuevoAlquiler {
            border-radius: 5px;
            max-width:700px;
            width:100%;
            margin: 20px auto;
            background-color: #FFFFFF;
            overflow: hidden;
        }

        #formNuevoAlquiler h1 {
            font-size: 18px;
            background: #F6AA93 none repeat scroll 0% 0%;
            color: rgb(255, 255, 255);
            padding: 22px 25px;
            border-radius: 5px 5px 0px 0px;
            margin: auto;
            text-shadow: none;
            text-align:left
        }




        .info p {
            text-align:center;
            color: #999;
            text-transform:none;
            font-weight:600;
            font-size:15px;
            margin-top:2px
        }

        .info i {
            color:#F6AA93;
        }




        p span {
            color: #F00;
        }

        p {
            margin: 0px;
            font-weight: 500;
            line-height: 2;
            color:#333;
        }

        h1 {
            text-align:center;
            color: #666;
            text-shadow: 1px 1px 0px #FFF;
            margin:50px 0px 0px 0px
        }

        #formNuevoAlquiler select, #formNuevoAlquiler textarea, #formNuevoAlquiler input {
            border-radius: 0px 5px 5px 0px;
            border: 1px solid #eee;
            width: 100% !important;

            float: left;
            padding: 0px 15px;
        }

        #formNuevoAlquiler select, #formNuevoAlquiler input {
            height: 36px;
        }

        a {
            text-decoration:inherit
        }

        textarea {
            height: 90px;
        }

        .form-group {
            overflow: hidden;
            clear: both;
        }

        .icon-case {
            width: 35px;
            float: left;
            border-radius: 5px 0px 0px 5px;
            background:#eeeeee;
            height:42px;
            position: relative;
            text-align: center;
            line-height:40px;
        }

        i {
            color:#555;
        }

        .contentform {
            padding: 10px 20px;
        }

        .bouton-contact{
            background-color: #81BDA4;
            color: #FFF;
            text-align: center;
            width: 100%;
            border:0;
            padding: 17px 25px;
            border-radius: 0px 0px 5px 5px;
            cursor: pointer;
            margin-top: 40px;
            font-size: 18px;
        }

        .leftcontact {
            width:49.5%;
            float:left;
            border-right: 1px dotted #CCC;
            box-sizing: border-box;
            padding: 0px 15px 0px 0px;
        }

        .rightcontact {
            width:49.5%;
            float:right;
            box-sizing: border-box;
            padding: 0px 0px 0px 15px;
        }

        .validation {
            display:none;
            margin: 0 0 10px;
            font-weight:400;
            font-size:13px;
            color: #DE5959;
        }

        #sendmessage {
            border:1px solid #fff;
            display:none;
            text-align:center;
            margin:10px 0;
            font-weight:600;
            margin-bottom:30px;
            background-color: #EBF6E0;
            color: #5F9025;
            border: 1px solid #B3DC82;
            padding: 13px 40px 13px 18px;
            border-radius: 3px;
            box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.03);
        }

        #sendmessage.show,.show  {
            display:block;
        }

    </style>
@endsection