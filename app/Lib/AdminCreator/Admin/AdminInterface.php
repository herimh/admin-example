<?php

/**
 * @TODO: Agregar deescripción de la clase
 *
 * @Author Heriberto Monterrubio <heri185403@gmail.com>
 * @Date 2016-05-29
 */

namespace App\Lib\AdminCreator\Admin;

use App\Lib\AdminCreator\Mappers\FieldMapper;

interface AdminInterface
{
    /**
     * @param $formMapper
     */
    public function configureFormFields(FieldMapper $formMapper);

    /**
     * @param $listMapper
     */
    public function configureListFields(FieldMapper $listMapper);

    /**
     * @param $showMapper
     */
    public function configureShowFields(FieldMapper $showMapper);

    /**
     * @param $filterMapper
     */
    public function configureFilterFields(FieldMapper $filterMapper);
}