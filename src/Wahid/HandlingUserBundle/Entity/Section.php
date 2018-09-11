<?php

namespace Wahid\HandlingUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Section
 *
 * @ORM\Table(name="section")
 * @ORM\Entity(repositoryClass="Wahid\HandlingUserBundle\Repository\SectionRepository")
 * @ORM\Entity
 * @UniqueEntity("name")
 */
class Section
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
     * @Assert\Length(
     *      min =4 ,
     *      max = 50,
     *      minMessage = "Le nom du section  doit contenir au minimum {{ limit }} caractères !",
     *      maxMessage = "Le nom du section  doit contenir au maximum {{ limit }} caractères !"
     * )
     */
    private $name;


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
     * @return Section
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
}
