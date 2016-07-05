<?php

namespace App\Lib\AdminCreator\Controller;

/**
 * Controller base para la sección de administración de la replica y el Master shop
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-14
 */

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Auth;

class BaseAdminController extends Controller
{
    use BatchActionsTrait, RequestAndQueryProcessTrait, ValidationAndSecurityTrait;

    private $modelClassName = null;
    private $adminClassName = null;
    //private $controllerPath = null;

    public $basicModuleName;
    protected $modelAdmin;

    /**Variable con un array de acciones adicionales a las acciones restufull,
     * Para uso de la consola para poder generar los permisos
    */
    public static $basicActions = ['list', 'create', 'show', 'edit', 'delete', 'export'];
    public static $additionalActions = [];

    /** Guarda una instancia de un QueryBuilder de Eloquent,
     * para construir el query del listado, es inicializado en el constructor.**/
    public $query;

    public function __construct()
    {
        $admin = $this->getAdminClassName();
        $this->modelAdmin =  new $admin();

        $this->basicModuleName = strtolower($this->getModuleName());

        //Inicializa el Query para el listado
        $model = $this->getModelClassName();
        $this->query = $model::query();
    }

    /**
     * Muestra el listado del modulo seleccionado
     * @param $access tipo de acceso(permiso) que podrá entrar a esa funcion
     * @return \Illuminate\Http\Response
     */
    public function index($access = 'list')
    {
        //Verifica permisos de listado
        $this->checkAccess($access);

        $this->processRequest();

        $this->queryFilters();
        $result = $this->query->paginate($this->modelAdmin->getMaxPerPage());

        return view($this->modelAdmin->listTemplate)->with([
            'result' => $result,
            'admin'  => $this->modelAdmin
        ]);
    }

    /**
     * Muestra el formulario para capturar nuevo registro
     *
     * @param $access tipo de acceso(permiso) que podrá entrar a esa funcion
     * @return \Illuminate\Http\Response
     */
    public function create($access = 'create')
    {
        $this->checkAccess($access);

        $model = $this->getModelClassName();
        $object = new $model();

        /**@TODO: Crear validación de Formulario del Admin vs Objeto del modelo y encapsular todo en el Admin */
        $this->modelAdmin->setModelObject($object);

        return view($this->modelAdmin->createTemplate)->with([
            'admin' => $this->modelAdmin
        ]);
    }

    /**
     * Guarda el nuevo registro
     *
     * @param $access tipo de acceso(permiso) que podrá entrar a esa funcion
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $access = 'create')
    {
        $this->checkAccess($access);
    
        $request = $request::all();

        if(!isset($request['form'])) {
            //@TODO: redirect ro Error: empty form
        }

        $model = $this->getModelClassName();
        $object = $model::create($request['form']);

        switch($request['post_action']){
            case 'create_and_new';
                return redirect()->route($this->modelAdmin->adminBaseRoute.'.create');
            case 'create_and_exit':
                return redirect()->route($this->modelAdmin->adminBaseRoute.'.index');
        }

        return redirect()->route($this->modelAdmin->adminBaseRoute.'.edit', ['id' => $object->id]);
    }


    /**
     * Visualiza detalladamente todos la información de un registro
     *
     * @param  int  $id
     * @param $access tipo de acceso(permiso) que podrá entrar a esa funcion
     * @return \Illuminate\Http\Response
     */
    public function show($id, $access = 'show')
    {
        $this->checkAccess($access);

        $model = $this->getModelClassName();
        $object = $model::findOrFail($id);

        if(!$object){
            //@TODO: redirect to "Not Found" page
        }

        /**@TODO: Crear validación de Formulario del Admin vs Objeto del modelo y encapsular todo en el Admin */
        $this->modelAdmin->setModelObject($object);

        return view($this->modelAdmin->showTemplate)->with([
            'admin' => $this->modelAdmin
        ]);
    }

    /**
     * Muestra el formulario para editar un registro
     *
     * @param  int  $id
     * @param $access tipo de acceso(permiso) que podrá entrar a esa funcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $access = 'edit')
    {
        $this->checkAccess($access);

        $model = $this->getModelClassName();
        $object = $model::findOrFail($id);

        if(!$object){
            //@TODO: redirect to "Not Found" page
        }

        /**@TODO: Crear validación de Formulario del Admin vs Objeto del modelo y encapsular todo en el Admin */
        $this->modelAdmin->setModelObject($object);
        $this->modelAdmin->hydrateFormFields($object);//@TODO: Verificar dependencias, refactorizar y eliminar

        return view($this->modelAdmin->editTemplate)->with([
            'admin' => $this->modelAdmin,
            'object' => $object ////@TODO: quitar esta entrada, usando directamente el del Admin
        ]);
    }

    /**
     * Actualiza la información de un registro
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param $access tipo de acceso(permiso) que podrá entrar a esa funcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $access = 'edit')
    {
        //@Verificar permisos de actualización
        $this->checkAccess($access);
   
        $request = $request::all();

        if($request['post_action'] == 'delete'){
            return $this->destroy($id);
        }

        $model = $this->getModelClassName();
        $object = $model::findOrFail($id);
        $this->modelAdmin->setModelObject($object);

        if(!$object){
            //@TODO: redirect to Not Found error
        }

        $object->update($request['form']);

        if($this->modelAdmin->hasGroupedFormFields()){
            foreach($this->modelAdmin->getFormFields() as $name=>$group){
                if(method_exists($object, $name)){
                    $inputs = $request[$name];
                    $modelClass = get_class($object->$name()->getRelated());

                    if(!$object->$name){
                        $relatedObject = new $modelClass($inputs);
                        $object->$name()->save($relatedObject);
                    }else{
                        $object->$name->update($inputs);
                    }
                }
            }
        }

        if($request['post_action'] == 'update_and_exit'){
            return redirect()->route($this->modelAdmin->adminBaseRoute.'.index');
        }

        return redirect()->route($this->modelAdmin->adminBaseRoute.'.edit', ['id' => $object->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkAccess('delete');

        $model = $this->getModelClassName();
        $object = $model::findOrFail($id);

        if(!$object){
            //@TODO: redirect to NOT FOUND error
        }

        $this->modelAdmin->setModelObject($object);
        $request = Request::all();

        if(isset($request['confirm_delete'])){
            if($request['confirm_delete']=='true'){
                $object->delete();
                //@TODO: setup flash notification
            }

            return redirect()->route($this->modelAdmin->adminBaseRoute.'.index');
        }

        return view($this->modelAdmin->deleteTemplate)->with([
            'admin' => $this->modelAdmin,
        ]);
    }

    protected function getModelClassName($model = null)
    {
        $moduleName = $this->getModuleName();
        if($model !== null){
            $moduleName = $model;
        }

        if($this->modelClassName == null){
            $this->modelClassName = "App\\Models\\Entities\\".$moduleName;
        }

        return $this->modelClassName;
    }

    protected function getAdminClassName()
    {
        if ($this->adminClassName == null) {
            $this->adminClassName = "App\\Http\\Admin\\".$this->getModuleName().'Admin';
        }

        return $this->adminClassName;
    }


    public function getModuleName()
    {
        $namespace = explode("\\", get_class($this));
        return str_replace('Controller', '', $namespace[count($namespace) -1]);
    }

    public function getBasicModuleName()
    {
        return strtolower($this->getModuleName());
    }
}
