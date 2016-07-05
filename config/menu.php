<?php
 	/*
    |--------------------------------------------------------------------------
    | Menu por default
    |--------------------------------------------------------------------------
    |
    | Arreglo donde se almacenaran las opciones que han de aparecen en el 
    | menú del backoffice (administrador de replica).
    |
    */

	return [

        /**
         * Cada Elemento dentro de master_shop_menu será mostrado en las opciones del mneú
         * siempre y cuando el usuario logeado tenga permisos para acceder al módulo
         *
         * Definición del contenido para cada elemento del menu
         * @item 'name': El nombre del menú, de preferencia que lleve el mismo nombre del controller (en minusculas)
         * @item 'label': Etiqueta a mostrar en la vista, por default mostrará como el valor de 'name', la vista ya contiene traducción
         * @item 'route': alias de la ruta(definición en laravel) para renderear en el menú, por default usa master-shop.{$item['name']}.index
         * @item 'permission': nombre del permiso necesario para visualizar el item, por default se valida con "list-{$item['name']}"
         * @item 'icon': Icono a mostrar para el item (nombre del icono en bootstrap para admin-lte)
         * @item 'children': Elementos para mostrar como submenú, cada sub-item soporta los mismos atributos que el del menu padre.
         */

		'admin_menu' => [
            ['name' => 'dashboard', 'icon' => 'fa-home', 'route' => '#'],
            ['name' => 'school', 'label' => 'label.school', 'icon'=>'fa-suitcase'],
            ['name' => 'student', 'label' => 'label.students', 'icon' => 'fa-users'],
            ['name' => 'reports', 'label' => 'label.reports', 'icon' => 'fa-users', 'route' => '#',
                'children' => [
                    ['name' => 'report1', 'label' => 'label.report_1', 'icon' => 'fa-user', 'route' => '#'],
                    ['name' => 'report 2', 'label' => 'label.report_2', 'icon' => 'fa-sitemap', 'route' => '#'],
                    ['name' => 'report2', 'label' => 'label.report_3', 'icon' => 'fa-key', 'route' => '#']
                ]
            ],
            ['name'  => 'user', 'label' => 'label.admin_users', 'icon' => 'fa-users', 'route' => '#',
                'children' => [
                    //['name' => 'user', 'label' => 'label.users', 'icon' => 'fa-user'],
                    //['name' => 'role', 'label' => 'label.roles', 'icon' => 'fa-sitemap'],
                    //['name' => 'permission', 'label' => 'label.permissions', 'icon' => 'fa-key']
                ]
            ],
		],



	/*
    |--------------------------------------------------------------------------
    | Menu Master shop
    |--------------------------------------------------------------------------
    |
    | Arreglo donde se almacenaran las opciones que han de aparecen en el 
    | menú del backoffice para el mastershop.
    |
    */
	];
