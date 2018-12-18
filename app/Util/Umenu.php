<?php

namespace App\Util;

use App\Menu;
use App\Util\Uuser;
use  Illuminate\Support\Facades\Route;

class Umenu extends Menu
{

    protected $table = 'menus';
    /*
        Devuelve todas las opciones de menu del usuario logueado
    */


    static function all_menues_new($family,$all=false){
        $ret=[];

        //echo ($family!='')?1:0;
        $user_grants = (Auth()->user())?\App\Util\Uuser::user_grants(Auth()->user()):['USER_GUEST'];

        $menues = Menu::orderby('position');
        if ($family!='') $menues = $menues->where('family',$family);

        foreach ($menues->get() as $mnu) {
            $menu_grants = self::menu_grants($mnu); // si es submenu, hereda del padre
            if (($mnu->active==true && Uuser::checks_grants($user_grants,$menu_grants)) || $all){ // si

                //echo $mnu->family."<br>";
                $ret[]=$mnu;
                /*if (is_null($mnu->parent)){
                    $ret[]=$mnu;
                } else {

                    $find=-1;
                    $k=0;
                    foreach ($ret as $k=>$rt){
                        if ($rt->id== $mnu->parent || $rt->parent == $mnu->parent ){
                            $find=$k+1;
                        } elseif($find>-1) break;
                    }

                    //$ret[]=$mnu->toArray();

                    if ($k==0) $ret[]=$mnu;
                    else
                        array_splice($ret, $k, 0, [$mnu]);

                }*/
            }
        }

        //var_dump($ret);
        //foreach($ret as $it) echo "$it->title $it->parent<br>";
        return $ret;
    }

    static function all_menues($family,$all=false){
        $ret=[];


        $user_grants = (Auth()->user())?\App\Util\Uuser::user_grants(Auth()->user()):['USER_GUEST'];

        $menues = Menu::orderby('family')->orderby('position')->orderby('parent');
        if ($family!='') $menues = $menues->where('family',$family);

        foreach ($menues->get() as $mnu) {
            $menu_grants = self::menu_grants($mnu); // si es submenu, hereda del padre
            if (Uuser::checks_grants($user_grants,$menu_grants) || $all){ // si
                if (!is_null($mnu->parent)){
                    if(isset($ret[$mnu->parent])){
                        $ret[$mnu->parent]['childs'][$mnu->id]=['data'=>$mnu, 'childs'=>[]];
                    }
                } else {
                    $ret[$mnu->id]=['data'=>$mnu, 'childs'=>[]];
                }
            }
        }
        return $ret;
    }

    /*
       Devuelve todas las opciones de menu del usuario logueado
   */
    static function menu_grants(Menu $menu){

        $ret=is_null($menu->grant_name)?[]:explode(',',$menu->grant_name);

        //habilitar que hereda del padre
        /*if ($parent=Menu::find($menu->parent))
            $ret=array_merge($ret,self::menu_grants($parent));*/

        return $ret;
    }

    /*
       Devuelve un link en function del menu
        referencia desde vista layout.menu
   */
    static function createLink(Menu $menu)
    {
        switch ($menu->linkref){
            case 'route':
                if (Route::has($menu->href))
                    return "!".route($menu->href,[],false);
                return "/".$menu->href;
                break;
            default:
                return $menu->href;
        }
    }

}
