<?php

namespace App\Lib\AdminCreator\Controller;

/**
 * Contiene funciones para usar los batch actions en el listado
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Excel;

trait BatchActionsTrait{

    /**
     * Funcion que recive el request de una acción en batch desde el listado
     * procesa y ejecuta la función/acción según sea el caso
     *
     * @param $action acción a realizar en batch
     * @return Function: función a la que está relacionado la acción
     */
    public function batchAction()
    {
        $action = Request::get('action');

        switch($action){
            case 'delete':
                return $this->batchDelete();
            case 'export':
                return $this->batchExport();
            case 'export_all':
                return $this->batchExport();
            default:
                return $this->{'batch'.ucfirst($action)}();
                break;
        }
    }

    /**
     * Realiza la acción de eliminar un grupo de elementos,
     * primero redirije a una vista para confirmar la eliminación,
     * despues elimina los registros y redirije al listado nuevamente.
     *
     * @param array $items elementos a eliminar
     * @return View|Redirect
     */
    private function batchDelete()
    {
        $request = Request::all();

        if(isset($request['confirm_delete'])){
            if($request['confirm_delete']=='true'){
                $batchItems = Request::session()->get('batch_items');
                $model = $this->getModelClassName();
                $model::destroy($batchItems);
            }

            return redirect()->route($this->modelAdmin->adminBaseRoute.'.index');
        }

        $batchItems = $request['batch_items'];
        Request::session()->flash('batch_items', $batchItems);

        return view('vendor.base_admin.delete')->with([
            'admin' => $this->modelAdmin,
            'is_batch_delete' => true,
            'items' => count($batchItems),
        ]);
    }

    /**
     * Reliza la acción de exportar un conjunto de registros en un archivo de excel.
     *
     * @param Array|Null $items elementos a exportar
     * @return  File : archivo en formato de excel
     */
    private function batchExport()
    {
        Excel::create('export_1', function($excel) {
            $excel->sheet($this->getModuleName(), function($sheet){
                $batchItems = Request::get('batch_items');
                $model = $this->getModelClassName();
                $query = $model::query();

                foreach($this->modelAdmin->getExportColumns() as  $column){
                    $query->addSelect($column);
                }

                $objects = $query->whereIn('id', $batchItems)->get();

                $sheet->fromArray($objects);
            });

        })->download('xlsx');
    }
}