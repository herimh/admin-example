@if(count(explode('.', $field_name)) > 1)
    @include('vendor.base_admin._list_widget_text', [
            'object' => $object->{explode('.', $field_name)[0]},
            'field_name' => explode('.', $field_name)[1]
        ])
@else
    @if($field['attributes']['editable'] == true && Auth::user()->can('edit-'.strtolower($admin->moduleName)))
        <span type="text" class="x-editable" data-name="{{$field_name}}" data-url="{{ route('xeditable.save',
        ['module' => $admin->moduleName]) }}" data-pk="{{ $object->id }}" data-type="text">{{$object->{$field_name} }}</span>
    @else
        {{$object->{$field_name} }}
    @endif
@endif

