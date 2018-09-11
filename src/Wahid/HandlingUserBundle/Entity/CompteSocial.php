<?php

namespace Wahid\HandlingUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * CompteSocial
 *
 * @ORM\Table(name="compte_social")
 * @ORM\Entity(repositoryClass="Wahid\HandlingUserBundle\Repository\CompteSocialRepository")
 */
class CompteSocial
{

    /**
     * @ORM\ManyToOne(targetEntity="Wahid\HandlingUserBundle\Entity\Etudiant",inversedBy="Compte_Social")
     * @ORM\JoinColumn(nullable=false)
     */

    private $etudiant;
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
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit contenir au minimum {{ limit }} caractères !",
     *      maxMessage = "Le nom doit contenir au maximum {{ limit }} caractères !"
     * )
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @ORM\Column(name="path", type="string", length=200)
     * @Assert\Url(
     *    message = "The url '{{ value }}' is not a valid url",
     * )
     */
    private $path;


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
     * @return CompteSocial
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
     * Set path
     *
     * @param string $path
     *
     * @return CompteSocial
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
     * Set etudiant
     *
     * @param \Wahid\HandlingUserBundle\Entity\Etudiant $etudiant
     *
     * @return CompteSocial
     */
    public function setEtudiant(\Wahid\HandlingUserBundle\Entity\Etudiant $etudiant)
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    /**
     * Get etudiant
     *
     * @return \Wahid\HandlingUserBundle\Entity\Etudiant
     */
    public function getEtudiant()
    {
        return $this->etudiant;
    }
}
