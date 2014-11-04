<?php

namespace MK\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MK\AdminBundle\Entity\Language;
use MK\AdminBundle\Form\LanguageType;

class LanguageController extends Controller
{
    public function indexAction()
    {
        $entityManger = $this->getDoctrine()->getManager();
        $languageRepo = $entityManger->getRepository('MKAdminBundle:Language');
        $listLanguage = $languageRepo->findAll();
 
        return $this->render('MKAdminBundle:Language:index.html.twig', array(
            'listLanguage' => $listLanguage
        ));
    }
    
    public function addAction(Request $request, $languageId = null)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $languageRepo = $entityManger->getRepository('MKAdminBundle:Language');
        
        if ($languageId === null) {
            $language = new Language();
            $formAction = $this->generateUrl('mk_admin_language_add');
            $typeAction = "add";
        } else {
            $language = $languageRepo->find($languageId);
            $formAction = $this->generateUrl('mk_admin_language_edit', array('languageId' => $language->getId()));
            $typeAction = "edit";
        }
        
        $form = $this->createForm(new LanguageType(), $language);
        $translator = $this->get('translator');
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            if ($form->isValid()) {
                $entityManger->persist($language);
                $entityManger->flush();
                //Set flash message
                $message = $translator->trans('language.form.create.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_language'));
            } else {
                $message = $translator->trans('language.form.create.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:Language:form.html.twig", array(
            'form' => $form->createView(),
            'formAction' => $formAction
        ));
    }
    
    public function setDefaultBackEndAction($languageId)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $languageRepo = $entityManger->getRepository('MKAdminBundle:Language');
        $listLangue = $languageRepo->findBy(array('isDefaultBackend' => true));
        foreach ($listLangue as $language) {
            $language->setIsDefaultBackend(false);
            $entityManger->persist($language);
            $entityManger->flush();
        }
        $language = $languageRepo->find($languageId);
        $language->setIsDefaultBackend(true);
        $entityManger->persist($language);
        $entityManger->flush();
        
        return $this->redirect($this->generateUrl('mk_admin_language'));
    }
    
    public function setDefaultFrontEndAction($languageId)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $languageRepo = $entityManger->getRepository('MKAdminBundle:Language');
        $listLangue = $languageRepo->findBy(array('isDefaultFrontend' => true));
        foreach ($listLangue as $language) {
            $language->setIsDefaultFrontend(false);
            $entityManger->persist($language);
            $entityManger->flush();
        }
        $language = $languageRepo->find($languageId);
        $language->setIsDefaultFrontend(true);
        $entityManger->persist($language);
        $entityManger->flush();
        
        return $this->redirect($this->generateUrl('mk_admin_language'));
    }
    
    /**
     * delete one product
     * 
     * @param Request $request
     * @param Integer $productId
     * 
     */
    public function deleteAction(Request $request, $productId)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $productRepo = $entityManger->getRepository('MKAdminBundle:Product');
        $product = $productRepo->find($productId);
        $translator = $this->get('translator');
        $form = $this->createFormBuilder()
                ->add('delete', 'submit', array("attr" => array('class' => "btn btn-primary")))
                ->getForm();
        
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            
            if ($form->isValid()) {
                $entityManger->remove($product);
                $entityManger->flush();
                
                 //Set flash message
                $message = $translator->trans('form.product.create.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_product'));
            } else {
                $message = $translator->trans('form.product.delete.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:Product:delete.html.twig", array(
            'form' => $form->createView(),
            'product' => $product
        ));
    }
}