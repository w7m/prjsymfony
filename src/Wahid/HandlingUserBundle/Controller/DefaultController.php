<?php

namespace Wahid\HandlingUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WahidHandlingUserBundle:Default:index.html.twig');
    }
}
