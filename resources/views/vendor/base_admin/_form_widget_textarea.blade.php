<div class="form-group {{$field['attributes']['form_class']}}">
    <label for="{{ $form }}_{{ $field['field_name'] }}" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @else
            {{ trans('label.'.$field['field_name']) }}
        @endif
    </label>
    <textarea type="textarea" class="form-control" id="{{ $form }}_{{ $field['field_name'] }}"
              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
              name="{{ $form }}[{{  $field['field_name'] }}]"
            @foreach($field['attributes']['attr'] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach
    > {{$field['attributes']['value']}}</textarea>
</div>