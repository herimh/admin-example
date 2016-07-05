<div class="filter-input col-sm-3">
    <label for="inputDateRange" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @endif
    </label>
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control pull-right daterange" readonly
               id="filter_{{ $field['field_name'] }}" name="filters[{{  $field['field_name'] }}]"
               value="{{  $field['attributes']['value'] }}">
    </div>
    <!-- /.input group -->
</div>