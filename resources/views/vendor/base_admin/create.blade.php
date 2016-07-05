@extends('layouts.admin_app')

@section('content-actions')
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route($admin->adminBaseRoute.'.index') }}">
                <i class="fa fa-bars"></i> {{ trans('label.return_to_list_'.$admin->moduleName) }}</a></li>
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
        <li class="active"><b>{{ trans('label.creating_'.$admin->moduleName) }}</b></li>
    </ol>
@endsection

@section('content')
    <div class="box with-border">
        <form action="{{  route($admin->adminBaseRoute.'.store')  }}" method="POST"
              id="{{ strtolower($admin->moduleName).'_create_form' }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">

                @include('vendor.base_admin._edit_form')

            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-success" name="post_action" value="create_and_edit" >
                    <i class="fa fa-save"></i> {{ trans('label.create_'.$admin->moduleName) }}</button>
                <button type="submit" class="btn btn-primary" name="post_action" value="create_and_new">
                    <i class="fa fa-plus"></i> {{ trans('label.create_and_new_'.$admin->moduleName) }}</button>
                <button type="submit" class="btn btn-primary" name="post_action" value="create_and_exit">
                    <i class="fa fa-bars"></i> {{ trans('label.create_and_exit_'.$admin->moduleName) }}</button>
            </div>
        </form>
    </div>
@stop