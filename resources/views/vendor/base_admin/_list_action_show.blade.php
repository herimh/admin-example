@if(Auth::user()->can($action.'-'.strtolower($admin->moduleName)) and (Route::has($admin->adminBaseRoute.'.show')))
<a href="{{ route($admin->adminBaseRoute.'.show', $object->id) }}" class="btn btn-default btn-sm" title="{{ trans('label.show') }}">
    <i class="fa fa-search"></i></a>
@endif