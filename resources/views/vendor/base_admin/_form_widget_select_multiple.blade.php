<div class="form-group {{$field['attributes']['form_class']}}">
    <label for="{{ $form }}_{{ $field['field_name'] }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field['field_name']) }}
        @endif
        @if($field['attributes']['required'] == 'true') * @endif
    </label>

    <select class="form-control select2" id="{{ $form }}_{{ $field['field_name'] }}" multiple
            name="{{ $form }}[{{  $field['field_name'] }}][]" style="width: 100%;"
            @if($field['attributes']['required'] == 'true') required @endif >
        @foreach($field['attributes']['choices'] as $index => $choice)
            @if(is_object($choice))
                <option value="{{ $choice->id }}"
                        @if(isset($object) && in_array($choice->id,$object->{$field['field_name']}()->lists('id')->toArray())) SELECTED @endif>
                    {{ $choice->{$field['attributes']['display_value']} }}</option>
            @else
                <option @if(isset($object) &&   in_array($index, $object->{$field['field_name']}()->lists('id')->toArray())) SELECTED @endif
                value="{{ $index }}">{{ $choice }}</option>
            @endif
        @endforeach
    </select>
</div>
