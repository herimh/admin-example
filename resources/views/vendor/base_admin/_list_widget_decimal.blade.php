@if(count(explode('.', $field_name)) > 1)
    @include('vendor.base_admin._list_widget_decimal', [
            'object' => $object->{explode('.', $field_name)[0]},
            'field_name' => explode('.', $field_name)[1]
        ])
@else
{!!  number_format($object->$field_name, $field['attributes']['decimals'], '.', ',') !!}
@endif