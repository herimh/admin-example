@if(Auth::user()->can($action.'-'.strtolower($admin->moduleName)) and (Route::has($admin->adminBaseRoute.'.destroy')))
    <form action="{{  route($admin->adminBaseRoute.'.destroy', $object->id)  }}" method="POST"
          class="btn btn-default btn-sm list-action-delete" title="{{ trans('label.delete') }}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <i class="fa fa-remove"></i>
    </form>
@endif