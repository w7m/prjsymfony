<?php

namespace Wahid\HandlingUserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Wahid\HandlingUserBundle\Entity\Cours;
use Wahid\HandlingUserBundle\Entity\Etudiant;
use Wahid\HandlingUserBundle\Entity\Media;
use Wahid\HandlingUserBundle\Form\CoursType;
use Wahid\HandlingUserBundle\Form\EtudiantType;
use Wahid\HandlingUserBundle\Entity\Section;
use Wahid\HandlingUserBundle\Form\SectionType;
use Wahid\HandlingUserBundle\Form\SectionEditType;
class chkpCrudFormController extends Controller
{
    public function showFormEtudiantAction()
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class,$etudiant,
            array('action'=>$this->generateUrl('wahid_projet_crud_add_etudiant_user')));
        return $this->render('@WahidHandlingUser/Default/addetudiant.html.twig',array('form'=>$form->createView()));
    }
    public function addEtudiantAction(Request $request)
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $compteSocial = $etudiant->getCompteSocials();
            foreach ($compteSocial as $compteSocialuni){
                $compteSocialuni->setEtudiant($etudiant);
                $em->persist($compteSocialuni);
            }
            $em->persist($etudiant);
            $em->flush();
            return $this->redirectToRoute('wahid_projet_crud_list_etudiant_user');
        } else {
            return $this->render('@WahidHandlingUser/Default/addetudiant.html.twig',array('form'=>$form->createView()));
        }

    }
    public function listEtudiantAction()
    {
        $em = $this->getDoctrine()->getManager();
        $etudiant = $em->getRepository('WahidHandlingUserBundle:Etudiant')->findAll();
        return $this->render('@WahidHandlingUser/Default/listetudiant.html.twig',array('etudiant'=>$etudiant));
    }
    public function detailStudentAction(Request $request,Etudiant $etudiant)
    {
        $session = $request->getSession();
        if($etudiant){
            return $this->render('@WahidHandlingUser/Default/detailstudent.html.twig',array('etudiant'=>$etudiant));
        }
        $session->getFlashBag()->add('notice', 'Etudiant inexistant');
        return $this->redirectToRoute('wahid_projet_crud_list_section_user');
    }

    public function deleteEtudiantAction(Request $request,$id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $etudiant = $em->getRepository('WahidHandlingUserBundle:Etudiant')->find($id);
        if ($etudiant)
        {
            $compteSocial = $etudiant->getCompteSocials();
            foreach ($compteSocial as $compteSocialuni){
                $em->remove($compteSocialuni);
            }
            //unlink(__DIR__."/../../../.."."/web/".$etudiant->getMedia()->getPath());
            $em->remove($etudiant);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Etudiant supprimé avec succès');
            return $this->redirectToRoute('wahid_projet_crud_list_etudiant_user');
        }
        $session->getFlashBag()->add('notice', 'Vérifier vos coordonnées');
        return $this->redirectToRoute('wahid_projet_crud_list_etudiant_user');
    }


    public function updateEtudiantAction(Request $request,Etudiant $etudiant)
    {
        $session = $request->getSession();
        if ($etudiant) {
            $form = $this->createForm(EtudiantType::class, $etudiant);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $compteSocial = $etudiant->getCompteSocials();
                foreach ($compteSocial as $compteSocialuni){
                    $compteSocialuni->setEtudiant($etudiant);
                    $em->persist($compteSocialuni);
                }
                $em->flush();
                $session->getFlashBag()->add('notice', 'Modification éffectué avec succès');
                return $this->redirectToRoute('wahid_projet_crud_list_section_user');
                //return $this->forward('WahidHandlingUserBundle:chkpCrudForm:listCous');
            }
            return $this->render('@WahidHandlingUser/Default/updateetudiant.html.twig',
                array('form' => $form->createView()));
        }
        $session->getFlashBag()->add('notice', 'Vérifier vos coordonnées');
        return $this->redirectToRoute('wahid_projet_crud_list_etudiant_user');
    }


    public function showFormCoursAction()
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class,$cours,
            array('action'=>$this->generateUrl('wahid_projet_crud_add_cours_user'))
        );
        return $this->render('@WahidHandlingUser/Default/addcours.html.twig',array('form'=>$form->createView()));
    }
    public function addCoursAction(Request $request)
    {
        $cour = new Cours();
        $form =$this->createForm(CoursType::class,$cour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cour);
            $em->flush();
            return $this->redirectToRoute('wahid_projet_crud_list_cours_user');
            //return $this->forward('WahidHandlingUserBundle:chkpCrudForm:listCous');
        } else {
            return $this->redirectToRoute('wahid_projet_crud_cours_show_formuser');
        }
    }
    public function listCousAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cours = $em->getRepository('WahidHandlingUserBundle:Cours')->findAll();
        return $this->render('@WahidHandlingUser/Default/listcours.html.twig',array('cours'=>$cours));
    }
    public function deleteCourAction(Request $request,$id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $cour = $em->getRepository('WahidHandlingUserBundle:Cours')->find($id);
        if ($cour)
        {
            $em->remove($cour);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Cour supprimé avec succès');
            return $this->redirectToRoute('wahid_projet_crud_list_cours_user');
        }
        $session->getFlashBag()->add('notice', 'Vérifier vos coordonnées');
        return $this->redirectToRoute('wahid_projet_crud_list_cours_user');


    }
    public function updateCousAction(Request $request, Cours $cour)
    {
        $session = $request->getSession();
        if ($cour) {
            $form = $this->createForm(CoursType::class, $cour);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $session->getFlashBag()->add('notice', 'Modification éffectué avec succès');
                return $this->redirectToRoute('wahid_projet_crud_list_cours_user');
                //return $this->forward('WahidHandlingUserBundle:chkpCrudForm:listCous');
            }
            return $this->render('@WahidHandlingUser/Default/updatecours.html.twig',
                array('form' => $form->createView()));
        }
        $session->getFlashBag()->add('notice', 'Vérifier vos coordonnées');
        return $this->redirectToRoute('wahid_projet_crud_list_section_user');
    }




    public function showFormsectionAction()
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class,$section,
            array('action' =>$this->generateUrl('wahid_projet_crud_add_section_user'))
        );
        return $this->render('@WahidHandlingUser/Default/addsection.html.twig',array('form'=>$form->createView()));
    }
    public function addSectionAction(Request $request)
    {
        $section = new Section();
        $form =$this->createForm(SectionType::class,$section);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($section);
            $em->flush();
            return $this->redirectToRoute('wahid_projet_crud_list_section_user');
            //return $this->forward('WahidHandlingUserBundle:chkpCrudForm:listCous');
        } else {
            return $this->redirectToRoute('wahid_projet_crud_section_show_formuser');
        }
    }

    public function listSectionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $section = $em->getRepository('WahidHandlingUserBundle:Section')->findAll();
        return $this->render('@WahidHandlingUser/Default/listsection.html.twig',array('section'=>$section));
    }
    public function deleteSectionAction(Request $request,$id)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $section = $em->getRepository('WahidHandlingUserBundle:Section')->find($id);
        if ($section)
        {

            $em->remove($section);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Section supprimé avec succès');
            return $this->redirectToRoute('wahid_projet_crud_list_section_user');
        }
        $session->getFlashBag()->add('notice', 'Vérifier vos coordonnées');
        return $this->redirectToRoute('wahid_projet_crud_list_section_user');
    }
    public function updateSectionAction(Request $request,Section $section)
    {
        $session = $request->getSession();
        if ($section) {
            $form = $this->createForm(SectionEditType::class, $section);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $session->getFlashBag()->add('notice', 'Modification éffectué avec succès');
                return $this->redirectToRoute('wahid_projet_crud_list_section_user');
                //return $this->forward('WahidHandlingUserBundle:chkpCrudForm:listCous');
            }
            return $this->render('@WahidHandlingUser/Default/updatesection.html.twig',
                array('form' => $form->createView()));
        }
        $session->getFlashBag()->add('notice', 'Vérifier vos coordonnées');
        return $this->redirectToRoute('wahid_projet_crud_list_section_user');
    }

}
