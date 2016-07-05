@if(Auth::user()->can($action.'-'.strtolower($admin->moduleName)) and (Route::has($admin->adminBaseRoute.'.edit')))
<a href="{{ route($admin->adminBaseRoute.'.edit', $object->id) }}" class="btn btn-default btn-sm" title="{{ trans('label.edit') }}">
    <i class="fa fa-edit"></i></a>
@endif