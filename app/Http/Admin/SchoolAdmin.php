<?php

namespace App\Http\Admin;

use App\Lib\AdminCreator\Admin\BaseAdmin;
use App\Lib\AdminCreator\Mappers\FilterFieldMapper;
use App\Lib\AdminCreator\Mappers\FormFieldMapper;
use App\Lib\AdminCreator\Mappers\ListFieldMapper;
use App\Lib\AdminCreator\Mappers\ShowFieldMapper;

class SchoolAdmin extends BaseAdmin
{
    protected function configureListFields(ListFieldMapper $listFieldMapper)
    {
        $listFieldMapper
            ->add('name', null, ['label' => 'label.name'])
            ->add('code', null, ['label' => 'label.code'])
            ->add('address', null, ['label' => 'label.address'])
            ->add('address', null, ['label' => 'label.address'])
            ->add('created_at', 'date', ['label' => 'label.created_at'])
            ->add('_actions',null,['label' => 'label.actions',
                'actions' => ['show', 'edit', 'delete']
            ])
        ;
    }

    protected function configureShowFields(ShowFieldMapper $showFieldMapper)
    {
        $showFieldMapper
            ->add('name', null, ['label' => 'label.name'])
            ->add('code', null, ['label' => 'label.code'])
            ->add('address', null, ['label' => 'label.address'])
            ->add('address', null, ['label' => 'label.address'])
            ->add('created_at', 'date', ['label' => 'label.created_at']);
    }

    protected function configureFormFields(FormFieldMapper $formFieldMapper)
    {
        $formFieldMapper
            ->add('name', 'text', ['label' => 'label.name'])
            ->add('code', 'text', ['label' => 'label.code'])
            ->add('address', 'textarea', ['label' => 'label.address']);
    }

    protected function configureFilterFields(FilterFieldMapper $filterFieldMapper)
    {
        $filterFieldMapper
            ->add('name', 'text', ['label' => 'label.name'])
            ->add('code', 'text', ['label' => 'label.code'])
            ->add('created_at', 'date', ['label' => 'label.created_at'])
            ->add('updated_at', 'date', ['label' => 'label.updated_at'])
        ;
    }


}