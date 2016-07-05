<?php

namespace App\Lib\AdminCreator\Admin;

/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-24
 */

use App\Lib\AdminCreator\Mappers\FilterFieldMapper;
use App\Lib\AdminCreator\Mappers\FormFieldMapper;
use App\Lib\AdminCreator\Mappers\ListFieldMapper;
use App\Lib\AdminCreator\Mappers\ShowFieldMapper;

trait AdminFieldsConfiguration{

    protected $formFieldMapper;
    protected $listFieldMapper;
    protected $showFieldMapper;
    protected $filterFieldMapper;

    /**
     * @param $formMapper
     */
    protected function configureFormFields(FormFieldMapper $formFieldMapper){

    }

    /**
     * @param $listMapper
     */
    protected function configureListFields(ListFieldMapper $listFieldMapper){

    }

    /**
     * @param $showMapper
     */
    protected function configureShowFields(ShowFieldMapper $showFieldMapper){

    }

    /**
     * @param $filterMapper
     */
    protected function configureFilterFields(FilterFieldMapper $filterFieldMapper){

    }

    public function getListFields()
    {
        if(!$this->listFieldMapper){
            $this->listFieldMapper = new ListFieldMapper();
            $this->configureListFields($this->listFieldMapper);
        }

        return $this->listFieldMapper->getFields();
    }

    public function getFormFields()
    {
        if(!$this->formFieldMapper){
            $this->formFieldMapper = new FormFieldMapper();
            $this->configureFormFields($this->formFieldMapper);

        }



        return empty($this->formFieldMapper->getGroups()) ? $this->formFieldMapper->getFields() :
            $this->formFieldMapper->getGroups();
    }

    public function getShowFields()
    {
        if(!$this->showFieldMapper){
            $this->showFieldMapper = new ShowFieldMapper();
            $this->configureShowFields($this->showFieldMapper);
        }

        return $this->showFieldMapper->getFields();
    }

    public function getFilterFields()
    {
        if(!$this->filterFieldMapper){
            $this->filterFieldMapper = new FilterFieldMapper();
            $this->configureFilterFields($this->filterFieldMapper);
        }

        return $this->filterFieldMapper->getFields();
    }

    //Agrega valores para cada FilterField con datos provenientes del filtro anterior
    public function hydrateFilterFields($filters){
        $this->getFilterFields();
        $this->filterFieldMapper->hydrateFields($filters);
    }

    //Agrega valores al formulario de editar
    public function hydrateFormFields($modelObject){
        $this->getFormFields();
        $this->formFieldMapper->hydrateFields($modelObject);
    }

    //Agrega valores al formulario de Show
    public function hydrateShowFields($modelObject){
        $this->getShowFields();
        $this->showFieldMapper->hydrateFields($modelObject);
    }

    public function hasGroupedFormFields(){
        $this->getFormFields();
        if(empty($this->formFieldMapper->getGroups())){
            return false;
        }

        return true;
    }

}