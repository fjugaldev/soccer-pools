<?php

namespace App\BackOffice\Infrastructure\Admin;

use App\Shared\Infrastructure\Entity\Tournament;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TournamentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current Image instance
        $image = $this->getSubject();

        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = ['required' => false];
        if ($image && ($webPath = $image->getWebPath())) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $basePath = $container->get('request_stack')->getCurrentRequest()->getBasePath();
            $basePath = 'http://localhost:8008';
            $fullPath = $basePath.'/'.$webPath;
            $preview = $image->getFile() !== null
                ? '<img src="'.$fullPath.'" class="admin-preview" style="border: 1px solid #000; width: 10%;" />'
                : '';

            // add a 'help' option containing the preview's img tag
            $fileFieldOptions = [
                'help' => $preview,
                'required' => true,
                'label' => 'Logo',
            ];
        }

        $formMapper
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('federation', ModelAutocompleteType::class, [
                'property' => 'name',
                'multiple' => false,
                'to_string_callback' => function($entity, $property) {
                    return $entity->getName();
                },
            ], [
                'placeholder' => 'No federation selected',
            ])
            ->add('fromDate', DateTimePickerType::class)
            ->add('toDate', DateTimePickerType::class)
            ->add('file', FileType::class, $fileFieldOptions)
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

    private function manageFileUpload(Tournament $tournament)
    {
        if ($tournament->getFile()) {
            $tournament->refreshUpdated();
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name', null, [
                'show_filter' => true
            ])
            ->add('fromDate', 'doctrine_orm_datetime', array('field_type' => DateTimePickerType::class,))
            ->add('toDate', 'doctrine_orm_datetime', array('field_type' => DateTimePickerType::class,))
            ->add('federation')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->add('federation');
        $listMapper->add('fromDate');
        $listMapper->add('toDate');
        $listMapper->add('logo', null, [
            'template' => "Admin/Team/list_thumb.html.twig"
        ]);
    }
}