<div class="wrapper-permissions">
	<table class="table table-striped table-bordered">
		<thead>
			<tr class="head-table-row">
				<td class="text-center">Módulos</td>
				<td class="text-center">Estatus</td>
			</tr>
		</thead>
		<tbody>
			@foreach($modules as $key => $module)
			<tr class="body-table-row">
				<td><div class="controllerName" title="">{!! $key !!}</div></td>
				<td>
					<div class="col-xs-4">
						<div class="col-xs-4">
							<input type="hidden" name="checkbox_module[all_checkbox][]" value="{!! $key !!}">
							<input type="checkbox" class="form-control full-icheck permission-checkbox" 
							name="checkbox_module[selected][]" value="{!! $key !!}" 
							@if($module) checked @endif >
						</div>
					</div>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

