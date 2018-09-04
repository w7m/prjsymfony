<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Personne;

class DefaultController extends Controller
{

    public function indexAction($ageMin,$ageMax)
    {

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('AppBundle:Personne');
        $personne = $repository->getPersonneByAgeInterval($ageMax,$ageMin);
        return $this->render('@App/Default/list.html.twig',array('personn'=>$personne));
    }
}
