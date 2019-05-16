<?php

namespace App\Api\Shared\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Federation extends BaseEntity
{
    const SERVER_PATH_TO_IMAGE_FOLDER = './uploads/logos/federations';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var Collection
     */
    private $tournaments;

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

    public function __construct()
    {
        $this->tournaments =  new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Federation
     */
    public function setName(string $name): Federation
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param string $logo
     * @return Federation
     */
    public function setLogo(string $logo): Federation
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTournaments(): Collection
    {
        return $this->tournaments;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    /**
     * Manages the copying of the file to the relevant place on the server
     */
    public function upload(): void
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and target filename as params
        $this->getFile()->move(
            self::SERVER_PATH_TO_IMAGE_FOLDER,
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->logo = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->setFile(null);
    }

    /**
     * Lifecycle callback to upload the file to the server.
     */
    public function lifecycleFileUpload(): void
    {
        $this->upload();
    }

    /**
     * Updates the hash value to force the preUpdate and postUpdate events to fire.
     */
    public function refreshUpdated(): void
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @return string
     */
    public function getWebPath(): string
    {
        return self::SERVER_PATH_TO_IMAGE_FOLDER.'/'.$this->getLogo();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }
}