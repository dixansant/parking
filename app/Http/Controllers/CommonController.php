<?php

namespace App\Http\Controllers;

use App\Notif;
use App\User;
use App\Contactu;
use Illuminate\Http\Request;
use App\Util\Mailto;
use App\Util\Notifs;
use Illuminate\Support\Facades\Auth;
use App\Tipo;
use App\Media;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Alquiler;




class CommonController extends Controller
{

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
    }

    /*Aqui viene cuando el login es correcto*/
    function homeAction(Request $request)
    {


        $page=$request->get('page')??1;
        $find=\App\Alquiler::orderby('id','desc');

        $info=[

            'items'=>$find->count(),
            'cajas'=>$find->skip(($page-1)*12)->take(12)->get(),
            'page'=>$page,
            'menu' => [
                'Inicio' => '#',
            ],
            'filtro'=>'Home',

        ];

        $link=($request->get('page'))?'home.alquiler.page':'home.partials';
        return view($link, $info);


        /*return view(
            'home.partials', [

            ]
        );*/
    }

    /**/
    function filtroAlquilerAction(Request $request)
    {


        $page=$request->get('page')??1;
        $find=\App\Alquiler::where('clasif','alquiler')->orderby('id','desc');

        $info=[

            'items'=>$find->count(),
            'cajas'=>$find->skip(($page-1)*12)->take(12)->get(),
            'page'=>$page,
            'menu' => [
                'Inicio' => '#',
                'Alquileres' => ''
            ],
            'filtro'=>'Alquiler',

        ];

        $link=($request->get('page'))?'home.alquiler.page':'home.alquiler.load';
        return view($link, $info);



    }

    /**/
    function filtroVentaAction(Request $request)
    {


        $page=$request->get('page')??1;
        $find=\App\Alquiler::where('clasif','venta')->orderby('id','desc');

        $info=[

            'items'=>$find->count(),
            'cajas'=>$find->skip(($page-1)*12)->take(12)->get(),
            'page'=>$page,
            'menu' => [
                'Inicio' => '#',
                'Venta' => ''
            ],
            'filtro'=>'Venta',

        ];


        $link=($request->get('page'))?'home.alquiler.page':'home.alquiler.load';

        return view($link, $info);

    }

    /*Aqui viene cuando el login es correcto*/
    function filtroAction( Request $request, Tipo $tipo)
    {

        $page=$request->get('page')??1;
        $find=\App\Alquiler::where('tipo',$tipo->nombre)->orderby('id','desc');

        $info=[
            'items'=>$find->count(),
            'cajas'=>$find->skip(($page-1)*12)->take(12)->get(),
            'page'=>$page,
            'menu' => [
                'Inicio' => '#',
                $tipo->nombre => ''
            ],
            'filtro'=>'Tipo'.$tipo->id,

        ];

        $link=($request->get('page'))?'home.alquiler.page':'home.alquiler.load';

        return view($link, $info);

    }



    /*Crear un alquiler*/
    function crearAction()
    {

        $alquiler = new Alquiler();
        $alquiler->handler = str_random(32);
        $alquiler->id=0;

        return view(
            'home.alquiler.crear', [
                'title' => __('Crear nueva Entrada:'),
                'alquiler'=>$alquiler,
            ]
        );

    }

    function editarAction(Alquiler $alquiler){
        return view(
            'home.alquiler.crear', [
                'title' => __('Editar una Entrada:'),
                'alquiler'=>$alquiler
            ]
        );
    }

    /*Salvar un alquiler*/
    function salvarAction(Request $request)
    {
        $id=$request->get('id');
        if (intval($id)>0)
          $alquiler = Alquiler::find($id);
        else
          $alquiler = new Alquiler();

        $alquiler->usuario = Auth()->user()->id;
        $alquiler->clasif = $request->get('clasif');
        $alquiler->tipo = $request->get('type');
        $alquiler->nombre = $request->get('nombre');
        $alquiler->descripcion = $request->get('descripcion');
        $alquiler->barrio = $request->get('address');
        $alquiler->telefono = $request->get('phone');
        $alquiler->horarios = $request->get('schedules');
        $alquiler->handler = $request->get('handler');
        $alquiler->imagen = $request->get('imagen');

        $alquiler->save();


    }

    /*Salvar un alquiler*/
    function mediaAction(Request $request)
    {

        $fileref = $request->file('media');
        $pop=$fileref->getClientOriginalName();

        $rules = array(
            'media' => 'required | mimes:jpeg,jpg,png | max:300000',
        );

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()){
            $filename = $fileref->store('temp_medias');
            $media = New Media();
            $media->handler = $request->get('handler');
            //$media->media = $pop . ":" .$filename;;
            $media->media = $filename;
            $media->save();
            echo "<script>parent.acceptMedia(true,'$pop','$filename')</script>";
        } else {
            echo "<script>parent.acceptMedia(false,'$pop')</script>";
        }
    }

    function tempMediaAction($filename) {


        $path = storage_path('app/temp_medias/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }


        $file = File::get($path);



        $type = File::mimeType($path);



        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);



        return $response;
    }


    function misAlquieresAction(){
        return view(
            'home.alquiler.mis_alq', [
                'alquiler'=> new Alquiler()
            ]
        );

    }


    function detallesAction(Alquiler $alquiler){
        return view(
            'home.alquiler.detalles', [
                'alquiler'=>$alquiler
            ]
        );
    }




}