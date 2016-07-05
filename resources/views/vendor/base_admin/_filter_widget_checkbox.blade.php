<div class="filter-input col-sm-2">
    <label for="inputText" class="control-label col-sm-12">&nbsp;&nbsp;</label>
    <input type="checkbox" class="form-control full-icheck" id="filter_{{ $field['field_name'] }}" name="filters[{{  $field['field_name'] }}]" >
    <label for="inputDate" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @endif
    </label>
</div>