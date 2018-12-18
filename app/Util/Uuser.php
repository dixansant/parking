<?php

namespace App\Util;

use App\User;
use App\Role;
use App\Priv;

class Uuser extends User
{

    protected $table = 'user';

    /*
        Devuelve los grants del user
    */
    static function user_grants(User $user)
    {
        $user_grants = is_null($user->grant_name)?[]:explode(',', $user->grant_name);
        $user_grants[] = 'USER_GRANT_' . $user->id;

        foreach ($user->roles()->get() as $role) {
            $role_grants = explode(',', $role->grant_name);
            $user_grants = array_merge($user_grants, $role_grants);
        }
        return $user_grants;
    }


    /*
        Devuelve el acceso de un usuario a una data (TRUE / FALSE)
    */
    static function checks_grants($user_grants, $grant_data)
    {

        foreach ($grant_data as $gd) {

            if ($gd=='ALL') return true;
            if ($gd=='USER_CHECK' && auth()->check()) return true;
            if ($gd=='USER_GUEST' && !auth()->check()) return true;
            if($gd_arr = Priv::where('destiny', $gd)->get()) {

                foreach ($gd_arr as $gd_item) {
                    $pt = explode(',', $gd_item->origen);
                    foreach ($pt as $grant) {

                        if (in_array($grant, $user_grants))

                            return true;

                    }
                }
            }
        }
        return false;

    }
}
