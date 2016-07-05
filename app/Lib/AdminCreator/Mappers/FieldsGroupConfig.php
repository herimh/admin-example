<?php
/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

namespace App\Lib\AdminCreator\Mappers;


trait FieldsGroupConfig
{
    protected $groups;

    protected function addGroup($name, array $attributes)
    {
        $attributes['form_name'] = 'form';
        if(isset($attributes['extra_model']) && $attributes['extra_model'] == true){
            $attributes['form_name'] = $name;
        }else{
            $attributes['extra_model'] = false;
        }

        if(!isset($attributes['active'])){
            $attributes['active'] = false;
        }

        $fieldMapperClass = get_class($this);
        $this->groups[$name] = [
            'data' => new $fieldMapperClass,
            'attributes' => $attributes
        ];

        return $this->groups[$name]['data'];
    }

    protected function getGroups(){
        return $this->groups;
    }
}