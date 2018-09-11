<?php

namespace Wahid\HandlingUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Etudiant
 *
 * @ORM\Table(name="etudiant")
 * @ORM\Entity(repositoryClass="Wahid\HandlingUserBundle\Repository\EtudiantRepository")
 * @ORM\Entity
 * @UniqueEntity("studentCardNumbers")
 */
class Etudiant
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
     * @var int
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Type(
     *     type="integer",
     *     message="Le numéros de la carte doit etre de type numeric"
     * )
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      exactMessage = "Le numéros de la carte doit avoir que huit chiffre."
     * )
     * @ORM\Column(name="studentCardNumbers", type="integer", unique=true)
     */
    private $studentCardNumbers;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le nom doit contenir au minimum {{ limit }} caractères !",
     *      maxMessage = "Le nom doit contenir au maximum {{ limit }} caractères !"
     * )
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @ORM\Column(name="firstName", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Le prénom doit contenir au minimum {{ limit }} caractères !",
     *      maxMessage = "Le prénom doit contenir au maximum {{ limit }} caractères !"
     * )
     */
    private $firstName;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     * @Assert\Date(message="Veuillez entrer une date valide")
     * @ORM\Column(name="datebirth", type="datetime")
     */
    private $datebirth;
    /**
     * @ORM\OneToOne(targetEntity="Wahid\HandlingUserBundle\Entity\Media",cascade={"persist","remove"})
     * @Assert\Valid
     */
    private $media;
    /**
     * @ORM\ManyToOne(targetEntity="Wahid\HandlingUserBundle\Entity\Section")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Veuillez remplir ce champs")
     */
    private $section;
    /**
     * @ORM\ManyToMany(targetEntity="Wahid\HandlingUserBundle\Entity\Cours")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull()
     */
    private $cours;

    /**
     * @ORM\OneToMany(targetEntity="Wahid\HandlingUserBundle\Entity\CompteSocial",mappedBy="etudiant",cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $compteSocials;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set studentCardNumbers
     *
     * @param integer $studentCardNumbers
     *
     * @return Etudiant
     */
    public function setStudentCardNumbers($studentCardNumbers)
    {
        $this->studentCardNumbers = $studentCardNumbers;

        return $this;
    }

    /**
     * Get studentCardNumbers
     *
     * @return int
     */
    public function getStudentCardNumbers()
    {
        return $this->studentCardNumbers;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Etudiant
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Etudiant
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set datebirth
     *
     * @param \DateTime $datebirth
     *
     * @return Etudiant
     */
    public function setDatebirth($datebirth)
    {
        $this->datebirth = $datebirth;

        return $this;
    }

    /**
     * Get datebirth
     *
     * @return \DateTime
     */
    public function getDatebirth()
    {
        return $this->datebirth;
    }

    /**
     * Set media
     *
     * @param \Wahid\HandlingUserBundle\Entity\Media $media
     *
     * @return Etudiant
     */
    public function setMedia(\Wahid\HandlingUserBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Wahid\HandlingUserBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set section
     *
     * @param \Wahid\HandlingUserBundle\Entity\Section $section
     *
     * @return Etudiant
     */
    public function setSection(\Wahid\HandlingUserBundle\Entity\Section $section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Wahid\HandlingUserBundle\Entity\Section
     */
    public function getSection()
    {
        return $this->section;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cours = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cour
     *
     * @param \Wahid\HandlingUserBundle\Entity\Cours $cour
     *
     * @return Etudiant
     */
    public function addCour(\Wahid\HandlingUserBundle\Entity\Cours $cour)
    {
        $this->cours[] = $cour;

        return $this;
    }

    /**
     * Remove cour
     *
     * @param \Wahid\HandlingUserBundle\Entity\Cours $cour
     */
    public function removeCour(\Wahid\HandlingUserBundle\Entity\Cours $cour)
    {
        $this->cours->removeElement($cour);
    }

    /**
     * Get cours
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * Add compteSocial
     *
     * @param \Wahid\HandlingUserBundle\Entity\CompteSocial $compteSocial
     *
     * @return Etudiant
     */
    public function addCompteSocial(\Wahid\HandlingUserBundle\Entity\CompteSocial $compteSocial)
    {
        $this->compteSocials[] = $compteSocial;

        return $this;
    }
    /**
     * Remove compteSocial
     *
     * @param \Wahid\HandlingUserBundle\Entity\CompteSocial $compteSocial
     */
    public function removeCompteSocial(\Wahid\HandlingUserBundle\Entity\CompteSocial $compteSocial)
    {
        $this->compteSocials->removeElement($compteSocial);
    }

    /**
     * Get compteSocials
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompteSocials()
    {
        return $this->compteSocials;
    }
}
