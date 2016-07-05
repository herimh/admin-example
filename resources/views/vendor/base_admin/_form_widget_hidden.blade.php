<input type="hidden" class="form-control" id="{{ $form }}_{{ $field['field_name'] }}"
           name="{{ $form }}[{{  $field['field_name'] }}]"
		   value="@if(isset($object)){{ $object->{$field['field_name']} }}@else {{ $field['attributes']['value'] }} @endif"
           @if($field['attributes']['required'] == 'true') required @endif
           @foreach($field['attributes']['attr'] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach
>