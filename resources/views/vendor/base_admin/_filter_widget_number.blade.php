<div class="filter-input col-sm-3">
    <label for="inputText" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @endif
    </label>
    <input type="number" class="form-control" id="filter_{{ $field['field_name'] }}"
           name="filters[{{  $field['field_name'] }}]" placeholder="" value="{{  $field['attributes']['value'] }}">
</div>