@if(count(explode('.', $field_name)) > 1)
    @include('vendor.base_admin._list_widget_currency', [
            'object' => $object->{explode('.', $field_name)[0]},
            'field_name' => explode('.', $field_name)[1]
        ])
@else
    {!! $field['attributes']['currency_type'] !!}
    {!!  number_format($object->{$field_name}, $field['attributes']['decimals'], '.', ',') !!}
@endif
