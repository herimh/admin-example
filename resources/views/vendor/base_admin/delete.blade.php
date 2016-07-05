@extends('layouts.admin_app')

@section('content-actions')
    <ul class="nav navbar-nav navbar-right">
        @if(Route::has($admin->adminBaseRoute.'.create') AND Auth::user()->can('create-'.$admin->moduleName))
        <li><a href="{{ route($admin->adminBaseRoute.'.create') }}">
                <i class="fa fa-plus-circle"></i> {{ trans('label.add_new') }}</a></li>
        @endif

        @if(Route::has($admin->adminBaseRoute.'.index') AND Auth::user()->can('list-'.$admin->moduleName))
        <li><a href="{{ route($admin->adminBaseRoute.'.index') }}">
                <i class="fa fa-bars"></i> {{ trans('label.return_to_list') }}</a></li>
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
        @if($admin->getModelObject())
            <li class="active">{{ trans('label.delete_'.strtolower($admin->moduleName)) }} {{ $admin->getModelObject()->id }}</li>
        @else
            <li class="active">{{ trans('label.batch_delete') }}</li>
        @endif
    </ol>
@endsection

@section('content')
    <div class="box with-border">
        <div class="box-header"></div>
        <div class="box-body">
            @if(isset($is_batch_delete))
                <h4>{{ trans('message.multiple_delete')}} {{ $items }} {{ trans('message.multiple_delete_'.$admin->moduleName)}}</h4>
            @else
                <h4>{{ trans('message.single_delete')}} {{ trans('message.single_delete_'.$admin->moduleName)}} <b>"{{ $admin->getModelObject() }}"</b></h4>
            @endif

            <h3>{{ trans('message.confirm_delete')}}</h3>
        </div>
        <div class="box-footer">
            <form action="
                @if( !isset($is_batch_delete) ) {{  route($admin->adminBaseRoute.'.destroy', $admin->getModelObject()->id)  }}
                @else {{  route($admin->adminBaseRoute.'.batch_action') }} @endif " method="POST">

                @if(isset($is_batch_delete))
                    <input type="hidden" name="action" value="delete">
                @else
                    <input type="hidden" name="_method" value="DELETE">
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger" name="confirm_delete" value="true">
                    <i class="fa fa-trash"></i> {{ trans('label.delete') }}</button>
                <button type="submit" class="btn btn-primary" name="confirm_delete" value="false">
                    <i class="fa fa-bars"></i> {{ trans('label.cancel') }}</button>
            </form>
        </div>
    </div>
@endsection