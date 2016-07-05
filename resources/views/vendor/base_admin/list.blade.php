@extends('layouts.admin_app')

@section('content-actions')
    <ul class="nav navbar-nav navbar-right">
        @if(Route::has($admin->adminBaseRoute.'.create') AND Auth::user()->can('create-'.$admin->moduleName))
        <li><a href="{{ route($admin->adminBaseRoute.'.create') }}">
                <i class="fa fa-plus-circle"></i> {{ trans('label.add_'.$admin->moduleName) }}</a></li>
        @endif
    </ul>
@endsection

@section('content-breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <i  class="fa fa-home"></i>{{ trans('label.dashboard') }}</a>
        </li>
        <li><a href="{{ route($admin->adminBaseRoute.'.index')  }}">
                {{ trans('label.'.strtolower($admin->moduleName.'s')) }}</a>
        </li>
        <li class="active"><b>{{ trans('label.list_of_'.strtolower($admin->moduleName)) }}</b></li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            @section('filters')
                <form action="" method="GET">
                    <div class="col-sm-9">
                        @foreach($admin->getFilterFields() as $field)
                            @include('vendor.base_admin._filter_widget_'.$field['field_type'])
                        @endforeach
                    </div>
                    <div class="col-sm-3">
                        <label class="control-label col-sm-12">&nbsp;&nbsp;</label>
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i> {{ trans('label.filter') }}
                            </button>
                            <a href="?reset=true" class="btn btn-default btn-sm">
                                <i class="fa fa-trash"></i> {{ trans('label.reset') }}
                            </a>
                        </div>
                    </div>
                </form>
            @show
        </div>
        <!-- /.box-body -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    @if($admin->hasBatchActions)
                        <th></th>
                    @endif

                    @foreach($admin->getListFields() as $field)
                        @if(isset($field['attributes']['label']))
                            <th>{{trans($field['attributes']['label']) }}</th>
                        @else
                            <th>{{trans('label.'.$field['field_name'])}}</th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($result as $object)
                    <tr>
                        @if($admin->hasBatchActions)
                            <td>
                                <input type="checkbox" name="batch_items[]" value="{{ $object->id }}"
                                       class="batch-item full-icheck" />
                            </td>
                        @endif
                        @foreach($admin->getListFields() as $field)
                            <td>
                            @if($field['field_name'] == '_actions')
                                <div class="btn-group btn-group-sm">
                                    @foreach($field['attributes']['actions'] as $key => $action)
                                        @if(in_array($action, ['show', 'edit', 'delete']))
                                            @include('vendor.base_admin._list_action_'.$action)
                                        @else
                                            @include($action, ['action' => $key])
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                @if(isset($field['attributes']['widget']))
                                    @include($field['attributes']['widget'])
                                @elseif($field['field_type']== null)
                                    @include('vendor.base_admin._list_widget_text', ['field_name' => $field['field_name']])
                                @else
                                    @include('vendor.base_admin._list_widget_'.$field['field_type'], ['field_name' => $field['field_name']])
                                @endif
                            @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                <tfoot>
                    <tr>
                        <td colspan="{{ count($admin->getListFields()) + 1 }}">
                            @if($admin->hasBatchActions)
                            <div class="batch-actions pull-left">
                                <form action="{{ route($admin->adminBaseRoute.'.batch_action') }}" method="post" id="submit_batch_action">

                                    <input type="checkbox" class="batch-select-all full-icheck" />
                                    <label>{{ trans('message.select_all') }}</label>

                                    <select class="select2 form-control" id="batch_action_select" required name="action" data-placeholder="{{ trans('label.action') }}">
                                        <option></option>
                                        @foreach($admin->batchActions as $action)
                                            @if($action == 'export')
                                                @if(Auth::user()->can($action.'-'.strtolower($admin->moduleName)))
                                                    <option value="export">{!! trans('label.export_selection') !!}</option>
                                                    <option value="export_all">{!! trans('label.export_all') !!}</option>
                                                @endif
                                            @elseif($action == 'delete')
                                                @if(Auth::user()->can($action.'-'.strtolower($admin->moduleName))
                                                    and (Route::has($admin->adminBaseRoute.'.destroy')))
                                                    <option value="{{ $action }}">{!! trans('label.'.$action) !!}</option>
                                                @endif
                                            @else
                                                @if(Auth::user()->can($action.'-'.strtolower($admin->moduleName)))
                                                    <option value="{{ $action }}">{!! trans('label.'.$action) !!}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                    <button type="sbmit" class="btn btn-primary"><i class="fa fa-check"></i>
                                        {{ trans('label.accept') }}</button>
                                </form>
                            </div>
                            @endif

                            <div  class="pull-right" >
                                <form action="" method="GET">
                                    <label>{{ trans('message.reg_per_page') }}</label>
                                    <select class="select2 form-control" data-placeholder="" name="_per_page" id="setPerPage">
                                        @foreach($admin->perPageItems as $item)
                                            <option href="#" @if($result->perPage() == $item) selected @endif> {{ $item }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>

                            <div  class="pull-right" style="padding: 5px 5px">
                                <label class="label label-default">{{ trans('label.page') }} {{ $result->currentPage() }} / {{ $result->lastPage() }}</label>
                                <label class="label label-default">{{ $result->total() }} {{ trans('label.registers') }}</label>
                            </div>

                            {{--  <div class="pull-right" style="padding: 0px 5px">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-share"></i> {{ trans('label.export') }}
                                    </button>
                                    <button aria-expanded="false" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="#"><label>{{ trans('label.all') }}</label></a>
                                            <ul class="dropdown-menu">
                                                @foreach($admin->exportTypes as $type)
                                                    <li><a href="#"><i class="fa fa-download"></i>{{ $type }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="#"><label>{{ trans('label.page') }} {{ $result->currentPage() }}</label></a>
                                            <ul class="dropdown-menu">
                                                @foreach($admin->exportTypes as $type)
                                                    <li><a href="#"><i class="fa fa-download"></i>{{ $type }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a tabindex="-1" href="#"><label>{{ trans('label.select') }}</label></a>
                                            <ul class="dropdown-menu">
                                                @foreach($admin->exportTypes as $type)
                                                    <li><a href="#"><i class="fa fa-download"></i>{{ $type }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- /.box-footer -->
        <div class="box-footer">
            <div class="pull-right">
                {!! $result->render() !!}
            </div>
        </div>
    </div>
@endsection