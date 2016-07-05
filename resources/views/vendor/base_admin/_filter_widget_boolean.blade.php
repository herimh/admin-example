<div class="filter-input col-sm-3">
    <label for="inputSelect" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @endif
    </label>
    <select class="form-control select2" id="filter_{{ $field['field_name'] }}"
            name="filters[{{  $field['field_name'] }}]" style="width: 100%;" data-placeholder="">
        <option></option>
        <option value="false" @if($field['attributes']['value'] == 'false') SELECTED @endif>{{ trans('label.false') }}</option>
        <option value="true" @if($field['attributes']['value'] == 'true') SELECTED @endif>{{ trans('label.true') }}</option>
    </select>
</div>