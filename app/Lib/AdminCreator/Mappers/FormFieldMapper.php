<?php
/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

namespace App\Lib\AdminCreator\Mappers;


class FormFieldMapper extends FieldMapper
{
    public function addGroup($name, array $attributes){
        return parent::addGroup($name, $attributes);
    }

    public function getGroups(){
        return parent::getGroups();
    }

    public function processAttributes(&$attributes)
    {
        parent::processAttributes($attributes);

        if(!isset($attributes['form_class'])){
            $attributes['form_class'] = 'col-sm-12';
        }

        if(!isset($attributes['attr'])){
            $attributes['attr'] = [];
        }
    }
}