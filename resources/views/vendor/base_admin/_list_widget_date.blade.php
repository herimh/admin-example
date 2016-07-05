@if(count(explode('.', $field_name)) > 1)
    @include('vendor.base_admin._list_widget_date', [
            'object' => $object->{explode('.', $field_name)[0]},
            'field_name' => explode('.', $field_name)[1]
        ])
@else
    @if($object->{$field_name})
        {!! date( $field['attributes']['format'], strtotime($object->{$field_name})) !!}
    @endif
@endif