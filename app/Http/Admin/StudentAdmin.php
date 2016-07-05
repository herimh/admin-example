<?php

namespace App\Http\Admin;

use App\Lib\AdminCreator\Admin\BaseAdmin;
use App\Lib\AdminCreator\Mappers\FilterFieldMapper;
use App\Lib\AdminCreator\Mappers\FormFieldMapper;
use App\Lib\AdminCreator\Mappers\ListFieldMapper;
use App\Lib\AdminCreator\Mappers\ShowFieldMapper;
use App\Models\Entities\School;

class StudentAdmin extends BaseAdmin
{
    protected function configureListFields(ListFieldMapper $listFieldMapper)
    {
        $listFieldMapper
            ->add('name', null, ['label' => 'label.name'])
            ->add('lastname', null, ['label' => 'label.lastname'])
            ->add('age', null, ['label' => 'label.age'])
            ->add('grade', null, ['label' => 'label.grade'])
            ->add('school.name', null, ['label' => 'label.school'])
            ->add('is_active', 'boolean', ['label' => 'label.is_active'])
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
            ->add('lastname', null, ['label' => 'label.lastname'])
            ->add('age', null, ['label' => 'label.age'])
            ->add('grade', null, ['label' => 'label.grade'])
            ->add('is_active', null, ['label' => 'label.is_active'])
            ->add('school', null, ['label' => 'label.school'])
            ->add('created_at', 'date', ['label' => 'label.created_at'])
            ->add('updated_at', 'date', ['label' => 'label.updated_at']);
    }

    protected function configureFormFields(FormFieldMapper $formFieldMapper)
    {
        $formFieldMapper
            ->add('name', 'text', ['label' => 'label.name'])
            ->add('lastname', 'text', ['label' => 'label.lastname'])
            ->add('age', 'text', ['label' => 'label.age'])
            ->add('grade', 'text', ['label' => 'label.grade'])
            ->add('school_id', 'select', ['label' => 'label.school',
                'choices' => School::all()->pluck('name', 'id')
            ])
            ->add('is_active', 'checkbox', ['label' => 'label.is_active']);
    }

    protected function configureFilterFields(FilterFieldMapper $filterFieldMapper)
    {
        $filterFieldMapper
            ->add('name', 'text', ['label' => 'label.name'])
            ->add('code', 'text', ['label' => 'label.code'])
            ->add('is_active', 'boolean', ['label' => 'label.is_active'])
            ->add('created_at', 'date', ['label' => 'label.created_at'])
            ->add('updated_at', 'date', ['label' => 'label.updated_at'])
        ;
    }


}