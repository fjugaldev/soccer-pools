<?php

namespace App\BackOffice\Infrastructure\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GroupAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('groupLetter', TextType::class)
            ->add('tournament', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No Tournament selected',
            ])
            ->add('teams', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => true,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No team selected',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('groupLetter')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->add('groupLetter');
    }
}