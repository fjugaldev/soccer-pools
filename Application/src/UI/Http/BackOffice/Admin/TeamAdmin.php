<?php

namespace App\UI\Http\BackOffice\Admin;

use App\Domain\Team\ValueObject\Team;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TeamAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_team';
    protected $baseRoutePattern = 'team';

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
                'label' => 'Flag',
            ];
        }

        $formMapper
            ->add('name', TextType::class)
            ->add('fifaCode', TextType::class)
            ->add('iso2', TextType::class, [
                'label' => 'ISO 2'
            ])
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
        $listMapper->add('fifaCode');
        $listMapper->add('iso2');
        $listMapper->add('flag', null, [
            'template' => "Admin/Team/list_thumb.html.twig"
        ]);
    }
}
