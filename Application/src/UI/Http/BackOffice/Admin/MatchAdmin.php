<?php

namespace InnovatikLabs\UI\Http\BackOffice\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MatchAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_match';
    protected $baseRoutePattern = 'match';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('tournament', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No Tournament selected',
            ])
            ->add('group', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName() . ' (' . $entity->getTournament()->getName() . ')';
                },
            ], [
                'placeholder' => 'No Tournament Group selected',
            ])
            ->add('phase', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName() . ' (' . $entity->getTournament()->getName() . ')';
                },
            ], [
                'placeholder' => 'No Tournament Phase selected',
            ])
            ->add('home', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No home Team selected',
            ])
            ->add('homeScore', IntegerType::class)
            ->add('visitor', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No visitor Team selected',
            ])
            ->add('visitorScore', IntegerType::class)
            ->add('date', DateTimePickerType::class)
            ->add('started', CheckboxType::class)
            ->add('ended', CheckboxType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('tournament')
            ->add('group')
            ->add('phase')
            ->add('home')
            ->add('home.name')
            ->add('visitor.name')
            ->add('visitor')
            ->add('started')
            ->add('ended')
            ->add('date', 'doctrine_orm_datetime', array('field_type' => DateTimePickerType::class,));
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('tournament');
        $listMapper->add('home');
        $listMapper->add('homeScore', null, ['label' => 'Score']);
        $listMapper->add('visitorScore', null, ['label' => 'Score']);
        $listMapper->add('visitor');
        $listMapper->add('group');
        $listMapper->add('phase');
        $listMapper->add('started');
        $listMapper->add('ended');
        $listMapper->add('date');
    }
}
