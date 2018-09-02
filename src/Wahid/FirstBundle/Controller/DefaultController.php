<?php

namespace Wahid\FirstBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\component\HttpFoundation\Request;
class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@WahidFirst/Default/firstpage.html.twig',array('var1'=>20));
    }
    public function secondAction()
    {
        return new response('Bonjour Le Monde ');
    }
    //SYMFONY_CONTROLLER_CHKP1_CV_ACTION
    public function portfolioAction($nom,$prenom,$age,$section)
    {
        return $this->render('@WahidFirst/Premier/cv.html.twig',
            array('nom'=>$nom,
                'nom'=>$nom,
                'prenom'=>$prenom,
                'age'=>$age,
                'section'=>$section));
    }
    //IMC = Indice de Masse Corporelle
    public function imcAction($weight,$tallness)
    {
        $imc = $weight/($tallness*$tallness);
        if ($imc>40) {
            $message = "obésité morbide ou massive";
        } elseif ($imc <= 40 && $imc>=35) {
            $message = "obésité sévère";
        } elseif ($imc<=35 && $imc>= 30) {
            $message = "obésité modérée";
        } elseif ($imc>25 && $imc<=30 ) {
            $message = "surpoids";
        } elseif ($imc>=16.5 && $imc<=25 ) {
            $message = "corpulence normale";
        } else {
            $message = "maigreur";
        }
        return $this->render('@WahidFirst/Premier/imc.html.twig',
            array('weight'=>$weight,
                'tallness'=>$tallness,
                'imc'=>$imc,
                'message'=>$message
                ));
    }
    //SYMFONY_ROUTE_CHKP1_ROOT_FROMAT
    public function checkAction($year,$page_name)
    {
        return new response("link valide");

    }


}
