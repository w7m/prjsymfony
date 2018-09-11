<?php

namespace Wahid\HandlingUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="Wahid\HandlingUserBundle\Repository\CoursRepository")
 */
class Cours
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
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @ORM\Column(name="numberModule", type="integer")
     */
    private $numberModule;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @ORM\Column(name="teacherName", type="string", length=100)
     */
    private $teacherName;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Cours
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set numberModule
     *
     * @param integer $numberModule
     *
     * @return Cours
     */
    public function setNumberModule($numberModule)
    {
        $this->numberModule = $numberModule;

        return $this;
    }

    /**
     * Get numberModule
     *
     * @return int
     */
    public function getNumberModule()
    {
        return $this->numberModule;
    }

    /**
     * Set teacherName
     *
     * @param string $teacherName
     *
     * @return Cours
     */
    public function setTeacherName($teacherName)
    {
        $this->teacherName = $teacherName;

        return $this;
    }

    /**
     * Get teacherName
     *
     * @return string
     */
    public function getTeacherName()
    {
        return $this->teacherName;
    }
}
