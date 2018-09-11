<?php

namespace Wahid\HandlingUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Media
 *
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="Wahid\HandlingUserBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     *
     * @Assert\File(
     *     maxSize = "1024k",
     *     maxSizeMessage="s'il vous plaît upload un image de taille max : 1M.",
     *     mimeTypes = {"image/jpeg"},
     *     mimeTypesMessage = "l'extension de l'image doit de type jpg."
     * )
     * @Assert\NotBlank(message="Veuillez insérer un fichier")
     */
    private $file;
    private $fileName;




    public function getId()
    {
        return $this->id;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Media
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Media
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file = null)
    {
        $this->file = $file;

    }
    /**
     * @ORM\PrePersist
     */
    public function hydrateObject()
    {
        $this->fileName = md5(uniqid()).".".$this->file->guessExtension();
        $this->setPath("upload/etudiant/".$this->fileName);
        $this->setAlt("xxxxxxxx");
    }

   /**
     * @ORM\PostPersist
     */
    public function uploadFile()
    {
        $this->file->move($GLOBALS['kernel']->getContainer()->getParameter('etudiant_media'),$this->fileName);
    }

    /**
     * @ORM\PreRemove()
     */
    public function getFileName()
    {
        $this->fileName = $this->path;
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeFile()
    {
        unlink(__DIR__."/../../../.."."/web/".$this->fileName);
    }



}
