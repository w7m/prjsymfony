<?php

namespace Wahid\SessionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ToDoController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('notes')){
            $notes = array('Mathématique'=>12,'Physique'=>13,'Informatique'=>7,'Français'=>11,'Anglais'=>14,'Histoire'=>5);
            $session->set('notes',$notes);
            $session->getFlashBag()->add('notice', 'Liste ajouté avec succès');
            return $this->render('@WahidSession/Default/index.html.twig');

        } else {
            return $this->render('@WahidSession/Default/index.html.twig');
        }
    }
    public function addToDoAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('notes')){
            $note = $session->get('notes');
            $input = array('SVT'=>12);
            //$key = array_search($value['Physique'], $note);
            if (array_key_exists(key($input), $note)){
                $note['Physique']=$input['Physique'];
                $session->set('notes',$note);
                $session->getFlashBag()->add('notice', 'Element modifié avec succès');
                return $this->render('@WahidSession/Default/index.html.twig');
            } else {
                $notes = array_merge($note,$input);
                $session->set('notes',$notes);
                $session->getFlashBag()->add('notice', 'Element Ajouté avec succès');
                return $this->render('@WahidSession/Default/index.html.twig');
            }
        } else {
            $session->getFlashBag()->add('notice', 'Liste n\'existe pas' );
            return $this->render('@WahidSession/Default/index.html.twig');
        }
    }
    public function deleteToDoAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('notes')) {
            $note = $session->get('notes');
            $key_input = 'Physique';
            if (array_key_exists($key_input, $note)){
                unset($note[$key_input]);
                $session->set('notes',$note);
                $session->getFlashBag()->add('notice', 'Element supprimé avec succès');
                return $this->render('@WahidSession/Default/index.html.twig');
            } else {
                $session->getFlashBag()->add('notice', 'Element n\'exist pas' );
                return $this->render('@WahidSession/Default/index.html.twig');
            }
        } else {
            $session->getFlashBag()->add('notice', 'Liste n\'exist pas ');
            return $this->render('@WahidSession/Default/index.html.twig');
        }
    }
    public function resetToDoAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->has('notes')) {
            $session->clear('notes');
            $notes = array('Mathématique' => 12, 'Physique' => 13, 'Informatique' => 7, 'Français' => 11, 'Anglais' => 14, 'Histoire' => 5);
            $session->set('notes', $notes);
            return $this->render('@WahidSession/Default/index.html.twig');
        } else {
            $session->getFlashBag()->add('notice', 'Liste n\'exist pas ');
            return $this->render('@WahidSession/Default/index.html.twig');
        }
    }
}
