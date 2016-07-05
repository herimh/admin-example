<div class="filter-input col-sm-2">
    <label for="inputDate" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @endif
    </label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control datepicker" id="inputDate" name="inputDate"
                   value="{{  $field['attributes']['value'] }}">
        </div>
</div>