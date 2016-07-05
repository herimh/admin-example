@foreach($menu as $item)
    @include("vendor.base_admin._menu_item", [
        'permission' => isset($item['permission'])?$item['permission']:"list-".$item['name'],
        'route' => isset($item['route'])? $item['route'] : $site.".".$item['name'].".index",
        'label' => isset($item['label']) ? trans($item['label']) : trans('label.'.$item['name']),
        'icon' =>  isset($item['icon']) ? $item['icon'] : "fa-link",
        'hasChildren' => (isset($item['children']) and !empty($item['children'])) ? true: false,
        'module' => $site.".".$item['name']
    ])
@endforeach