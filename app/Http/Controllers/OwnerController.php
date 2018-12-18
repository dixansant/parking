<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Util\Umenu;
use Illuminate\Http\Request;

class OwnerController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMenuAction()
    {

        $menus=[];

        //agrupar los menu por familia para acomodar en la vista
        $all_menus= Umenu::all_menues_new('',true);
        foreach( $all_menus as $menu){
            $menus[$menu->family][]=$menu;
        }

        return view('owner.mnubuilder',[
            'menus'=>$menus
        ]);
    }


    /*Adicionar nuevo menu */
    public function newMenuAction(Request $request)
    {

        if ($parent=Menu::find($request->get('parent')));
        else $parent=(object)[
            'id'=>0,
            'family'=>'menu.main'
        ];

        $menu = new Menu();
        $menu->title = 'New Menu '.rand(10000,99999);
        $menu->parent = $parent->id;
        $menu->family = $parent->family;

        $menu->save();

        $menu->position = $menu->id;
        $menu->save();


        return view('owner.response.newmenu',[
            'menu'=>$menu,
            'parent'=>$parent
        ]);
    }

    /* Salvar menu */
    public function saveMenuAction(Request $request)
    {

        $menu = Menu::find($request->get('id'));

        $menu->title = $request->get('title');
        $menu->description = $request->get('description');
        $menu->linkref = $request->get('linkref');
        $menu->href = $request->get('href');
        $menu->grant_name = $request->get('grant_name');
        $menu->active = $request->get('active')=='on';

        $menu->save();

        if ($parent = Menu::find($menu->parent));
        else {
            $parent = (object)[
                'id'=>0,
                'family'=>'menu.main'
            ];
        }


        return view('owner.response.savemenu',[
            'menu'=>$menu,
            'parent'=>$parent

        ]);
    }

    /* Salvar menu */
    public function moveMenuAction(Request $request)
    {

        $item = Menu::find($request->get('item'));
        if ($dest = Menu::find($request->get('dest')));
        else {
            $dest= (object)[
                'id'=>0,
                'family'=>'menu.main'
            ];
        }

        $item->family=$dest->family;
        $item->parent=$dest->id;
        $item->save();

        $allpos=explode(',',$request->get('order'));
        foreach ($allpos as $t=>$id){
            $it=Menu::find($id);
            $it->position=($t+1);
            $it->save();
        }


        return;
    }


    /* Eliminar menu */
    public function removeMenuAction(Request $request)
    {

        $item = Menu::find($request->get('item'));
        $childs=$this->getChilds([$item->id]);

        return view('owner.response.removemenu',[
            'menu'=>$item,
        ]);

        return;
    }

    private function getChilds($arr){

        foreach($arr as $it){
            $childs=Menu::where('parent',$it)->get();
            foreach ($childs as $child){
                //$arr[]=$child->id;
                $morechild = $this->getChilds([$child->id]);
                $arr=array_merge($arr, $morechild);
            }
        }
        Menu::whereIn('id',$arr)->delete();
        return $arr;
    }
}
