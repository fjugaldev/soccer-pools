<?php

namespace App\BackOffice\Infrastructure\Admin;

use App\Shared\Infrastructure\Entity\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeamAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class)
            ->add('fifaCode', TextType::class)
            ->add('iso2', TextType::class, [
                'label' => 'ISO 2'
            ])
            ->add('file', FileType::class, [
                'required' => true,
                'label' => 'Flag'
            ])
        ;
    }

    public function prePersist($team)
    {
        $this->manageFileUpload($team);
    }

    public function preUpdate($team)
    {
        $this->manageFileUpload($team);
    }

    private function manageFileUpload(Team $team)
    {
        if ($team->getFile()) {
            $team->refreshUpdated();
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('fifaCode')
            ->add('iso2')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('fifaCode');
        $listMapper->addIdentifier('iso2');
        $listMapper->addIdentifier('flag');
    }
}