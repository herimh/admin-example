    @extends('layouts.admin_app')

@section('content-actions')
    <ul class="nav navbar-nav navbar-right">
        @if(Route::has($admin->adminBaseRoute.'.create') AND Auth::user()->can('create-'.$admin->moduleName))
        <li><a href="{{ route($admin->adminBaseRoute.'.create') }}">
                <i class="fa fa-plus-circle"></i> {{ trans('label.add_'.$admin->moduleName) }}</a></li>
        @endif

        @if(Route::has($admin->adminBaseRoute.'.index') AND Auth::user()->can('list-'.$admin->moduleName))
        <li><a href="{{ route($admin->adminBaseRoute.'.index') }}">
                <i class="fa fa-bars"></i> {{ trans('label.return_to_list_'.$admin->moduleName) }}</a></li>
        @endif
    </ul>
@endsection

@section('content-breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}"><i  class="fa fa-home"></i>{{ trans('label.dashboard') }}</a></li>
        <li><a href="{{ route($admin->adminBaseRoute.'.index')  }}">
                {{ trans('label.'.strtolower($admin->moduleName.'s')) }}</a>
        </li>
        <li class="active"><b>{{ trans('label.edit_'.strtolower($admin->moduleName)) }} "{{ $admin->getModelObject() }}"</b></li>
    </ol>
@endsection

@section('content')
    <div class="box with-border">
        <div class="box-header">
        </div>

        <form action="{{  route($admin->adminBaseRoute.'.update', $admin->getModelObject()->id)  }}" method="POST"
              id="{{ strtolower($admin->moduleName).'_edit_form' }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('vendor.base_admin._edit_form')

            <div class="box-footer">
                <button type="submit" class="btn btn-success" name="post_action" value="update_and_edit" >
                    <i class="fa fa-save"></i> {{ trans('label.save_'.$admin->moduleName) }}</button>

                <button type="submit" class="btn btn-primary" name="post_action" value="update_and_exit">
                    <i class="fa fa-bars"></i> {{ trans('label.save_return_to_list') }}</button>

                @if(Route::has($admin->adminBaseRoute.'.destroy') AND Auth::user()->can('destroy-'.$admin->moduleName))
                <span> ó </span>
                <button type="submit" class="btn btn-danger" name="post_action" value="delete">
                    <i class="fa fa-trash"></i> {{ trans('label.delete_'.$admin->moduleName) }}</button>
                @endif
            </div>
        </form>
    </div>
@endsection