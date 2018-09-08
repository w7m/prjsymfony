<?php

namespace Wahid\ProjetTwigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wahid\ProjetTwigBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function indexAction(Request $request)
    {
        $response = new Response("<h1>fzzzzzzzzzzzz</h1>");

        return $this->render('@WahidProjetTwig/Default/index.html.twig',array('request'=>$request,'response'=>$response));
    }


    /*public function cvAction()
    {
        return $this->render('@WahidProjetTwig/Default/cv.html.twig');
    }
    public function cvsAction()
    {
        if (file_exists(__DIR__.'/../../../../web/images/user.png')){
            $personne1 = new PersonneTwig("mhamdi","wahid","29","images/user.png");
        } else {
            $personne1 = new PersonneTwig("mhamdi","wahid","29","images/user1.png");
        }

        if (file_exists(__DIR__.'/../../../../web/images/fdedfgf.png')){
            $personne2 = new PersonneTwig("mhamdi","youssef","22","images/fdedfgf.png");
        } else {
            $personne2 = new PersonneTwig("mhamdi","wahid","29","images/user1.png");
        }



        if (file_exists(__DIR__.'/../../../../web/images/user.png')){
            $personne3 = new PersonneTwig("mhamdi","mouhamed","24","images/user.png");
        } else {
            $personne3 = new PersonneTwig("mhamdi","wahid","29","images/user1.png");
        }



        if (file_exists(__DIR__.'/../../../../web/images/sdefv.png')){
            $personne4 = new Personne("mhamdi","zaid","32","images/user.png");
        } else {
            $personne4 = new Personne("mhamdi","zaid","32",'images/user1.png');
        }
        $personn = array('personne1'=>$personne1,
                         'personne2'=>$personne2,
                         'personne3'=>$personne3,
                         'personne4'=>$personne4);
        return $this->render('@WahidProjetTwig/Default/cvs.html.twig',array('personn'=>$personn));
    }*/
    public function addAction(Request $request, $name,$first_name,$age,$path)
    {

        $em = $this->getDoctrine()->getManager();
        if (file_exists(__DIR__.'/../../../../web/'.$path)){
            $session = $request->getSession();
            $session->getFlashBag()->add('notice', 'Utilisateur ajouté avec succès');
            $user = new Users($name,$first_name,$age,$path);
        } else {
            $session = $request->getSession();
            $session->getFlashBag()->add('notice', 'Utilisateur ajouté avec une image par défaut');
            $user = new Users($name,$first_name,$age,'images/user1.png');
        }
        $em->persist($user);
        $em->flush();
        return $this->forward('WahidProjetTwigBundle:Users:list');

    }
    public function updateAction(Request $request,Users $user=null)
    {
        if ($user){
            if ($user->getAge()>10){
                $age = $user->getAge()-10;
                $user->setAge($age);
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $session = $request->getSession();
                $session->getFlashBag()->add('notice', 'Utilisateur modifié avec succès');
                return $this->forward('WahidProjetTwigBundle:Users:list');
            } else {
                $session = $request->getSession();
                $session->getFlashBag()->add('notice', 'vous êtes assez jeune');
                return $this->forward('WahidProjetTwigBundle:Users:list');
            }
        } else {
            $session = $request->getSession();
            $session->getFlashBag()->add('notice', 'utilisateur inexistant');
            return $this->forward('WahidProjetTwigBundle:Users:list');
        }
        
    }
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('WahidProjetTwigBundle:Users')->findAll();
        return $this->render('@WahidProjetTwig/Default/list.html.twig',array('personn'=>$users));
    }
    public function getuserAction(Users $user)
    {
        return $this->render('@WahidProjetTwig/Default/cv.html.twig',array('personn'=>$user));
    }
    public function deleteAction(Request $request,Users $user=null)
    {
        if ($user){
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            $session = $request->getSession();
            $session->getFlashBag()->add('notice', 'utilisateur supprimé');
            return $this->forward('WahidProjetTwigBundle:Users:list');
        } else {
            $session = $request->getSession();
            $session->getFlashBag()->add('notice', 'utilisateur inexistant');
            return $this->forward('WahidProjetTwigBundle:Users:list');
        }
    }
    public function seletcuserbyageAction($ageMin,$ageMax)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('WahidProjetTwigBundle:Users');
        $user = $repository->getUserByAgeInterval($ageMin,$ageMax);
        return $this->render('@WahidProjetTwig/Default/listbyage.html.twig',array('personn'=>$user));
    }

    public function seletcuserbynameAction($word)
    {

        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('WahidProjetTwigBundle:Users');
        $user = $repository->getUserByname($word);
        return $this->render('@WahidProjetTwig/Default/listbyage.html.twig',array('personn'=>$user));
    }

}
