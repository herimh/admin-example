<?php
/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

namespace App\Lib\AdminCreator\Mappers;


class ListFieldMapper extends FieldMapper
{
    protected function processAttributes(&$attributes)
    {
        if(!isset($attributes['currency_type'])){
            $attributes['currency_type'] = '$';
        }
        if(!isset($attributes['decimals'])){
            $attributes['decimals'] = '2';
        }
        if(!isset($attributes['format'])){
            $attributes['format'] = 'Y-M-d';
        }
        if(!isset($attributes['editable'])){
            $attributes['editable'] = false;
        }
    }

}