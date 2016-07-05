@if( $object->{$field['field_name']} != null)
    {{ $object->{$field['field_name']}->{$field['attributes']['display_text']} }}
@endif