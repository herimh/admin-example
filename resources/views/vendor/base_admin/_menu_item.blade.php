@if(Auth::user()->can($permission))
    <li class="treeview @if((isset($admin) and $admin->adminBaseRoute == $module) || Request::route()->getName() == $route) active menu-active @endif">
        <a href="@if($hasChildren || $route == '#')#@else {{ route($route) }} @endif">
            <i class="fa {{ $icon }}"></i><span>{{ $label }}</span>
            @if($hasChildren) <i class="fa fa-angle-left pull-right"></i> @endif
        </a>
        @if($hasChildren)
            <ul class="treeview-menu" style="padding-left: 15px;">
                @include('vendor.base_admin._menu', ['menu' => $item['children'], 'site' => $site])
            </ul>
        @endif
    </li>
@endif