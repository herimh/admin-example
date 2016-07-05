@extends('layouts.admin_app')

@section('content-actions')
    <ul class="nav navbar-nav navbar-right">
        @if(Route::has($admin->adminBaseRoute.'.create') AND Auth::user()->can('create-'.$admin->moduleName))
            <li>
                <a href="{{ route($admin->adminBaseRoute.'.create') }}">
                    <i class="fa fa-plus-circle"></i> {{ trans('label.add_'.$admin->moduleName) }}</a>
            </li>
        @endif

        @if(Route::has($admin->adminBaseRoute.'.index') AND Auth::user()->can('list-'.$admin->moduleName))
            <li>
                <a href="{{ route($admin->adminBaseRoute.'.index') }}">
                    <i class="fa fa-bars"></i> {{ trans('label.return_to_list_'.$admin->moduleName) }}</a>
            </li>
            @endif
    </ul>
@endsection

@section('content-breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i  class="fa fa-home"></i>{{ trans('label.dashboard') }}</a></li>
        <li><a href="{{ route($admin->adminBaseRoute.'.index')  }}">
                {{ trans('label.'.strtolower($admin->moduleName.'s')) }}</a>
        </li>
        <li class="active">{{ trans('label.show_'.$admin->moduleName) }} <b>"{{ $admin->getModelObject() }}"</b></li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <tbody>
                    @foreach($admin->getShowFields() as $field)
                        <tr>
                            <th class="col-sm-2">
                                @if(isset($field['attributes']['label']))
                                    {{ trans($field['attributes']['label']) }}
                                @else
                                    {{ trans('label.'.$field['field_name']) }}
                                @endif
                            </th>
                            <td>
                                @if(count(explode('.', $field['field_name'])) > 1)
                                    {!! $admin->getModelObject()->{explode('.', $field['field_name'])[0]}->{explode('.', $field['field_name'])[1]} !!}
                                @else
                                    {!! $admin->getModelObject()->{$field['field_name']} !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            @if(Route::has($admin->adminBaseRoute.'.edit') AND Auth::user()->can('edit-'.$admin->moduleName))
                <a href="{{  route($admin->adminBaseRoute.'.edit', $admin->getModelObject()->id)  }}" class="btn btn-primary">
                    <i class="fa fa-edit"></i>{{ trans('label.edit_'.$admin->moduleName) }}</a>
                <span> ó </span>
            @endif

            @if(Route::has($admin->adminBaseRoute.'.destroy') AND Auth::user()->can('destroy-'.$admin->moduleName))
                <form action="{{  route($admin->adminBaseRoute.'.destroy', $admin->getModelObject()->id)  }}" method="POST" class="btn btn-danger show-action-delete">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <i class="fa fa-trash"></i> {{ trans('label.delete_'.$admin->moduleName) }}
                </form>
            @endif
        </div>
    </div>
@endsection