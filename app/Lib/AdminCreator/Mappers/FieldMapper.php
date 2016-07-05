<?php
namespace App\Lib\AdminCreator\Mappers;

/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

class FieldMapper
{
    use FieldsGroupConfig;

    private $fields;

    public function __construct()
    {
        $this->fields = [];
        $this->groups = [];
    }

    /**
     * @param $field: nombre del campo mapeado en la tabla de esta entidad
     * @param $fieldType: tipo de dato definido en la BD (si es nullo se usara un widget de acuerdo al dato encontrado)
     * @param array $attributes: otros atributos,tales como etiqueta, formato (fecha, moneda, etc.),
     * @return $this
     */
    public function add($field, $fieldType, array $attributes){

        $this->processAttributes($attributes);

        $this->fields[] = [
            'field_name' => $field,
            'field_type' => $fieldType,
            'attributes' => $attributes,
        ];

        return $this;
    }

    //Inicializa atributos para usarlos en el template
    protected function processAttributes(&$attributes)
    {
        if(!isset($attributes['value'])){
            $attributes['value'] = '';
        }
        if(!isset($attributes['text_type'])){
            $attributes['text_type'] = 'text';
        }
        if(!isset($attributes['required'])){
            $attributes['required'] = 'true';
        }
    }

    public function hydrateFields($values){
        if(!empty($this->groups)){
            foreach($this->groups as $index=>$group){
                $this->groups[$index]['data']->hydrateFields($values);
            }
        }

        if(is_array($values)){
            foreach($this->fields as &$field){
                if(isset($values[$field['field_name']]) &&
                    !empty($values[$field['field_name']])){
                    $field['attributes']['value'] = $values[$field['field_name']];
                }
            }
        }else{
            foreach($this->fields as &$field){
                $field['attributes']['value'] = $values->{$field['field_name']};
            }
        }

    }

    public function getFields(){
        return $this->fields;
    }
}