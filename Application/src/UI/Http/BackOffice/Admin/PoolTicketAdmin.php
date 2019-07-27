<?php

namespace InnovatikLabs\UI\Http\BackOffice\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PoolTicketAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_pool_ticket';
    protected $baseRoutePattern = 'pool_ticket';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('pool', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No TournamentPool selected',
            ])
            ->add('match', ModelAutocompleteType::class, [
                'property' => ['home.name', 'visitor.name'],
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return '[ '.$entity->getPhase()->getName().' ] - ( '.$entity->getDate()->format('Y-m-d').' ) '.$entity->getHome()->getName() . ' vs ' .$entity->getVisitor()->getName() ;
                },
            ], [
                'placeholder' => 'No TournamentPool selected',
            ])
            ->add('homeScore', IntegerType::class)
            ->add('visitorScore', IntegerType::class)
            ->add('player', ModelAutocompleteType::class, [
                'property' => ['firstName', 'lastName', 'username'],
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getFirstName().' '.$entity->getLastName().' ('.$entity->getEmail().')';
                },
            ], [
                'placeholder' => 'No player selected',
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('pool')
            ->add('match')
            ->add('player.firstName')
            ->add('player.lastName')
            ->add('player.username')
            ->add('player.email')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('pool');
        $listMapper->add('match');
        $listMapper->add('homeScore', null, ['label' => 'H. Score']);
        $listMapper->add('visitorScore', null, ['label' => 'V. Score']);
        $listMapper->add('Player', null, [
            'template' => "Admin/PoolTicket/player_info.html.twig"
        ]);
    }
}
