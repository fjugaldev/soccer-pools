<?php

namespace App\UI\Http\BackOffice\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TournamentPoolAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin';
    protected $baseRoutePattern = 'tournament-pool';

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
                'placeholder' => 'No tournament selected',
            ])
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('maxPlayers', IntegerType::class)
            ->add('hitVictoryPoints', IntegerType::class)
            ->add('hitTiePoints', IntegerType::class)
            ->add('hitScorePoints', IntegerType::class)
            ->add('hitVisitorScorePoints', IntegerType::class)
            ->add('hitHomeScorePoints', IntegerType::class)
            ->add('private', CheckboxType::class, [
                'required' => false,
            ])
            ->add('accessCode', TextType::class, [
                'required' => false,
            ])
            ->add('owner', ModelAutocompleteType::class, [
                'property' => ['firstName', 'lastName', 'username'],
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getFirstName().' '.$entity->getLastName().' ('.$entity->getEmail().')';
                },
            ], [
                'placeholder' => 'No owner selected',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('tournament')
            ->add('owner')
            ->add('private')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('tournament');
        $listMapper->add('owner');
        $listMapper->add('private');
    }
}
