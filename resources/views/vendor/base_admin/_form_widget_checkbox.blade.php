<div class="form-group {{$field['attributes']['form_class']}}">
    <input type="checkbox" class="form-control full-icheck" id="{{ $form }}_{{ $field['field_name'] }}"
           name="{{ $form }}[{{  $field['field_name'] }}]" placeholder=""
           @if(isset($object) && $object->{$field['field_name']} == true) checked @endif>
    <label for="{{ $form }}_{{ $field['field_name'] }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field['field_name']) }}
        @endif
    </label>
</div>