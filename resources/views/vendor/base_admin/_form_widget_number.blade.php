<div class="form-group {{$field['attributes']['form_class']}}">
    <label for="{{ $form }}_{{ $field_name }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field_name) }}
        @endif
    </label>

    <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="text" class="form-control" id="{{ $form }}_{{ $field_name }}"
               name="{{ $form }}[{{  $field_name }}]" placeholder=""
               value="@if(isset($object)){{ $object->{$field_name} }}@endif">
    </div>
</div>

