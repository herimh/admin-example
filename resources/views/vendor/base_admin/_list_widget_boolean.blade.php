@if(count(explode('.', $field_name)) > 1)
    @include('vendor.base_admin._list_widget_boolean', [
            'object' => $object->{explode('.', $field_name)[0]},
            'field_name' => explode('.', $field_name)[1]
        ])
@else
    <span class="label {{$object->{$field_name} == true ? 'label-success' : 'label-danger'}}">
    {{ $object->{$field_name} == true ? trans('label.true') : trans('label.false') }}
</span>
@endif
