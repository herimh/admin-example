<div class="form-group {{$field['attributes']['form_class']}}">
    <label for="{{ $form }}_{{ $field['field_name'] }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field['field_name']) }}
        @endif
    </label>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="date" class="form-control datepicker" name="{{ $form }}[{{  $field['field_name'] }}]"
               id="{{ $form }}_{{ $field['field_name'] }}" placeholder=""
               value="@if(isset($object)) {{ $object->{$field['field_name']} }} @endif">
    </div>
</div>