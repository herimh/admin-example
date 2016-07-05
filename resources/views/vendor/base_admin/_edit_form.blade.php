<div class="box-body">
    @if($admin->getModelObject() and $admin->getModelObject()->id)
        <input type="hidden" name="form[id]" value="{{ $admin->getModelObject()->id }}">
    @endif

    @if($admin->hasGroupedFormFields() == true)
        <ul class="nav nav-tabs">
            @foreach($admin->getFormFields() as $index => $group)
                <li class="@if($group['attributes']['active']) active @endif">
                    <a aria-expanded="true" href="#tab_{{ $index }}" data-toggle="tab">
                        {{ trans($group['attributes']['label']) }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" style="padding: 20px 15px;">
            @foreach($admin->getFormFields() as $index => $group)
                <div class="tab-pane @if($group['attributes']['active']) active @endif" id="tab_{{ $index }}">
                    @if ($group['attributes']['extra_model'])
                        @foreach( $group['data']->getFields() as $field)
                            @if($field['field_type'] == null)
                                @include($field['attributes']['widget'], ['form' =>$group['attributes']['form_name'],
                                'field_name' => $field['field_name'], 'object' => $admin->getModelObject()->$index])
                           @else
                               @include('vendor.base_admin._form_widget_'.$field['field_type'],
                                   ['form' =>$group['attributes']['form_name'], 'field_name' => $field['field_name'],
                                       'object' => $admin->getModelObject()->$index])
                           @endif
                       @endforeach
                   @else
                       @foreach( $group['data']->getFields() as $field)
                            @if($field['field_type'] == null)
                                @include($field['attributes']['widget'],
                                ['form' =>$group['attributes']['form_name'], 'object' =>$admin->getModelObject(),
                                    'field_name' => $field['field_name']])
                            @else
                                @include('vendor.base_admin._form_widget_'.$field['field_type'],
                                ['form' =>$group['attributes']['form_name'], 'object' => $admin->getModelObject(),
                                    'field_name' => $field['field_name']])
                            @endif
                       @endforeach
                   @endif
               </div>
           @endforeach
       </div>
   @else
       @foreach( $admin->getFormFields() as $field)
           @include('vendor.base_admin._form_widget_'.$field['field_type'], ['form' =>'form',
            'object' => $admin->getModelObject(), 'field_name' => $field['field_name']])
       @endforeach
   @endif
</div>