<div class="form-group {{$field['attributes']['form_class']}}">
    <label for="{{ $form }}_{{ $field['field_name'] }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field['field_name']) }}
        @endif
        @if(!isset($object->id) && $field['attributes']['required'] == 'true') * @endif
    </label>
    <input type="password" class="form-control" id="{{ $form }}_{{ $field['field_name'] }}"
           name="{{ $form }}[{{  $field['field_name'] }}]" placeholder="" value=""
           @if(!isset($object->id) && $field['attributes']['required'] == 'true') required @endif >
    <span class="text-red unequal-password-label hide">Las contraseñas no son iguales</span>
</div>