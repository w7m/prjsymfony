<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 01/09/2018
 * Time: 18:29
 */

namespace Wahid\ProjetTwigBundle\Entity;


class Personne
{
    private $nom;
    private $prenom;
    private $age;
    private $path;

    /**
     * Personne constructor.
     * @param $nom
     * @param $prenom
     * @param $age
     * @param $path
     */
    public function __construct($nom, $prenom, $age, $path)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->age = $age;
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

}