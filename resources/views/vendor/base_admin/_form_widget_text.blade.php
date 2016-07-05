<div class="form-group {{$field['attributes']['form_class']}}">
    <label for="{{ $form }}_{{ $field_name }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field_name) }}
        @endif
        @if($field['attributes']['required'] == 'true') * @endif
    </label>
    <input type="{{  $field['attributes']['text_type'] }}" class="form-control" id="{{ $form }}_{{ $field_name }}"
           name="{{ $form }}[{{  $field_name }}]"
           value="@if(!is_null($object)){{$object->$field_name}}@endif"
           @if($field['attributes']['required'] == 'true') required @endif
           @foreach($field['attributes']['attr'] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach
    >
</div>