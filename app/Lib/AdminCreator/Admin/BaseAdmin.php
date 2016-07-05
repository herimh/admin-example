<?php

namespace App\Lib\AdminCreator\Admin;

/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

class BaseAdmin
{
    /**
     * Hereda los métodos para la configuración del CRUD
     */
    use AdminFieldsConfiguration;

    //Define la ubicación de los templates básicos
    public $listTemplate = 'vendor.base_admin.list';
    public $showTemplate = 'vendor.base_admin.show';
    public $editTemplate = 'vendor.base_admin.edit';
    public $createTemplate = 'vendor.base_admin.create';
    public $deleteTemplate = 'vendor.base_admin.delete';

    public $adminBaseRoute;
    public $moduleName;

    public $hasBatchActions = true;
    public $batchActions = ['delete', 'export'];
    public $perPageItems = [200,100,50,30,20,10,5];
    protected $maxPerPage = 20;

    private $modelObject = null;

    //By default use the listFields configuration
    public $exportColumns = [];
    public $exportTypes = ['xlsx'=>'MS Excel', 'csv'=>'CSV', 'json' => 'JSON'];

    public function __construct()
    {
        $this->moduleName = $this->getModuleName();

        $this->adminBaseRoute = 'admin.'.strtolower($this->getModuleName());
    }

    private function getModuleName(){
        $namespace = explode("\\", get_class($this));
        return str_replace('Admin', '', $namespace[count($namespace) -1]);
    }

    public function setMaxPerPage($perPage){
        $this->maxPerPage = $perPage;
    }

    public function getMaxPerPage(){
        return $this->maxPerPage;
    }

    public function getExportColumns(){
        if(!empty($this->exportColumns)){
            return $this->exportColumns;
        }

        $columns = [];
        foreach($this->getListFields() as $field){
            if($field['field_name'] != '_actions')
            $columns[] = $field['field_name'];
        }

        return $columns;
    }

    public function setModelObject($object){
        $this->modelObject = $object;
    }

    public function getModelObject(){
        return $this->modelObject;
    }

}