<?php

namespace App\Lib\AdminCreator\Controller;

/**
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-14
 */

use Illuminate\Support\Facades\Request;
use Excel;

trait RequestAndQueryProcessTrait{
    /**
     * Procesa los filtros provenientes del request del listado y los aplica al query
     * para consultar el nuevo listado.
     *
     * @param QueryBuilder $query:  query donde se aplicarán los filtros
     */
    protected function queryFilters()
    {
        $filters = Request::session()->get($this->basicModuleName.'.filters');

        if(!$filters){
            return;
        }

        foreach($this->modelAdmin->getFilterFields() as $filterField)
        {
            if(isset($filters[$filterField['field_name']]) &&
                !empty($filters[$filterField['field_name']]))
            {
                $filterFieldValue = $filters[$filterField['field_name']];

                if($filterField['field_type'] == 'date_range'){
                    list($startDate, $finalDate) = explode(' - ', $filterFieldValue);
                    $this->query->where($filterField['field_name'], '>=', $startDate.' 00:00:00')
                        ->where($filterField['field_name'], '<=', $finalDate.' 23:59:59');
                }
                elseif($filterField['field_type'] == 'text'){
                    $this->query->where($filterField['field_name'], 'LIKE',
                        "%".$filters[$filterField['field_name']]."%");
                }
                elseif ($filterField['field_type'] == 'boolean'){
                    $boolValue = $filterFieldValue == 'true' ? 1 : 0;
                    $this->query->where($filterField['field_name'], $boolValue);
                }
                //@TODO: Agregar mas casos especiales
                else{
                    $this->query->where($filterField['field_name'], $filterFieldValue);
                }
            }
        }

        $this->modelAdmin->hydrateFilterFields($filters);
    }

    /**
     * Procesa en session los filtros y aciones aplicados al listado en el request anterior.
     * tales como pagina actual, elementos por página, filtros, etc.
     */
    protected function processRequest()
    {
        $request = Request::all();

        if(isset($request['reset'])){
            Request::session()->forget($this->basicModuleName);
        }

        //Procesa los filtros provenientes del Request y los guarda temporalmente en session
        if(isset($request['filters']) && !empty($request['filters'])){
            Request::session()->put($this->basicModuleName.'.filters', $request['filters']);
        }

        //Procesa la definición del maximo número de registros por página en el listado
        if(isset($request['_per_page'])){
            Request::session()->put($this->basicModuleName.'.per_page', $request['_per_page']);
        }

        //Precesa la paginacion
        if(isset($request['page'])){
            Request::session()->put($this->basicModuleName.'.page', $request['page']);
        }else{
            Request::replace(['page' => Request::session()->get($this->basicModuleName.'.page', 1)]);
        }

        //Carga el valor al Admin
        if(Request::session()->get($this->basicModuleName.'.per_page')){
            $this->modelAdmin->setMaxPerPage(Request::session()->get($this->basicModuleName.'.per_page'));
        }
    }
}