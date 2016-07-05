<?php

namespace App\Lib\AdminCreator\Controller;

/**
 * Contiene funciones para usar los batch actions en el listado
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-16
 */

use Auth;

trait ValidationAndSecurityTrait{

    /**
     * Verifica si el Usuario tiene cierto permiso al módulo.
     *
     * @param $action: tipo de permiso i.e.: list, show, edit, create ...
     */
    public function checkAccess($action)
    {
        $permissionName = strtolower($action.'-'.$this->getModuleName());

        if(!Auth::user()->can($permissionName)){
            abort(403, 'Unauthorized action.');
        }
    }
}