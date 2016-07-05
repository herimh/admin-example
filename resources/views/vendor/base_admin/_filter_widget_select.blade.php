<div class="filter-input col-sm-3">
    <label for="inputSelect" class="control-label">
        @if(isset($field['attributes']['label']))
            {{ trans($field['attributes']['label']) }}
        @endif
    </label>
    <select class="form-control select2" id="filter_{{ $field['field_name'] }}"
            name="filters[{{  $field['field_name'] }}]" style="width: 100%;"
            @if(isset($field['attributes']['attr']))
                @foreach($field['attributes']['attr'] as $attr => $value) {{ $attr }}="{{ $value }}" @endforeach
            @endif>
        <option value=""></option>
        @foreach($field['attributes']['choices'] as $index => $choice)
            @if(is_object($choice))
                <option value="{{ $choice->id }}"  @if ($field['attributes']['value'] == $choice->id) SELECTED @endif>{{ $choice->{$field['attributes']['display_value']} }}</option>
            @else
                <option value="{{ $index }}" @if ($field['attributes']['value'] == $index) SELECTED @endif>{{ $choice }}</option>
            @endif
        @endforeach
    </select>
</div>