<?php

namespace App\UI\Http\BackOffice\Admin;

use App\Domain\Federation\ValueObject\Federation;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FederationAdmin extends AbstractAdmin
{
    protected $baseRouteName = 'admin_federation';
    protected $baseRoutePattern = 'federation';

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

    private function manageFileUpload(Federation $federation)
    {
        if ($federation->getFile()) {
            $federation->refreshUpdated();
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('name');
        $listMapper->add('logo', null, [
            'template' => "Admin/Team/list_thumb.html.twig"
        ]);
    }
}
