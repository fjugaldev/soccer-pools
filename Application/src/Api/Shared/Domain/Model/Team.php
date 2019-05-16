<?php

namespace App\Api\Shared\Domain\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Team extends BaseEntity
{
    const SERVER_PATH_TO_IMAGE_FOLDER = './uploads/flags';

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
    private $fifaCode;

    /**
     * @var string
     */
    private $iso2;

    /**
     * @var string
     */
    private $flag;

    /**
     * Unmapped property to handle file uploads
     */
    private $file;

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
        $this->flag = $this->getFile()->getClientOriginalName();

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
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Team
     */
    public function setName(string $name): Team
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFifaCode(): ?string
    {
        return $this->fifaCode;
    }

    /**
     * @param string $fifaCode
     * @return Team
     */
    public function setFifaCode(string $fifaCode): Team
    {
        $this->fifaCode = $fifaCode;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getIso2(): ?string
    {
        return $this->iso2;
    }

    /**
     * @param string $iso2
     * @return Team
     */
    public function setIso2(string $iso2): Team
    {
        $this->iso2 = $iso2;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFlag(): ?string
    {
        return $this->flag;
    }

    /**
     * @param string $flag
     * @return Team
     */
    public function setFlag(string $flag): Team
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return string
     */
    public function getWebPath(): string
    {
        return self::SERVER_PATH_TO_IMAGE_FOLDER.'/'.$this->getFlag();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }


}
