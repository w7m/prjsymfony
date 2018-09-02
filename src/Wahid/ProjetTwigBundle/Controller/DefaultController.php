<?php

namespace Wahid\ProjetTwigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Wahid\ProjetTwigBundle\Entity\Personne;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@WahidProjetTwig/Default/index.html.twig');
    }
    public function cvAction()
    {
        return $this->render('@WahidProjetTwig/Default/cv.html.twig');
    }
    public function cvsAction()
    {
        if (file_exists(__DIR__.'/../../../../web/images/user.png')){
            $personne1 = new Personne("mhamdi","wahid","29","images/user.png");
        } else {
            $personne1 = new Personne("mhamdi","wahid","29","images/user1.png");
        }

        if (file_exists(__DIR__.'/../../../../web/images/fdedfgf.png')){
            $personne2 = new Personne("mhamdi","youssef","22","images/fdedfgf.png");
        } else {
            $personne2 = new Personne("mhamdi","wahid","29","images/user1.png");
        }



        if (file_exists(__DIR__.'/../../../../web/images/user.png')){
            $personne3 = new Personne("mhamdi","mouhamed","24","images/user.png");
        } else {
            $personne3 = new Personne("mhamdi","wahid","29","images/user1.png");
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
    }

}
