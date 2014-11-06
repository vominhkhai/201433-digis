<?php

namespace MK\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MK\AdminBundle\Entity\Category;
use MK\AdminBundle\Form\CategoryType;

class CategoryController extends Controller
{
    public function indexAction()
    {
        $entityManger = $this->getDoctrine()->getManager();
        $categoryRepo = $entityManger->getRepository('MKAdminBundle:Category');
        $listCategory = $categoryRepo->findAll();
 
        return $this->render('MKAdminBundle:Category:index.html.twig', array(
            'listCategory' => $listCategory
        ));
    }
    
    public function addAction(Request $request, $categoryId = null)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $categoryRepo = $entityManger->getRepository('MKAdminBundle:Category');
        $translator = $this->get('translator');
         
        if ($categoryId === null) {
            $category = new Category();
            $formAction = $this->generateUrl('mk_admin_category_add');
            $typeAction = "add";
            $titleBreadcum = $translator->trans('category.add', array(), 'admin_messages');
        } else {
            $category = $categoryRepo->find($categoryId);
            $formAction = $this->generateUrl('mk_admin_category_edit', array('categoryId' => $category->getId()));
            $typeAction = "edit";
            $titleBreadcum = $translator->trans('category.edit', array(), 'admin_messages');
        }
        
        $form = $this->createForm(new CategoryType(), $category);
       
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            if ($form->isValid()) {
                $entityManger->persist($category);
                $entityManger->flush();
                //Set flash message
                $message = $translator->trans('category.form.create.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_category'));
            } else {
                $message = $translator->trans('category.form.create.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:Category:form.html.twig", array(
            'form' => $form->createView(),
            'formAction' => $formAction,
            'titleBreadcum' => $titleBreadcum
        ));
    }
    
    /**
     * delete one product
     * 
     * @param Request $request
     * @param Integer $productId
     * 
     */
    public function deleteAction(Request $request, $categoryId)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $categoryRepo = $entityManger->getRepository('MKAdminBundle:Category');
        $category = $categoryRepo->find($categoryId);
        $translator = $this->get('translator');
        $form = $this->createFormBuilder()
                ->add('delete', 'submit', array("attr" => array('class' => "btn btn-primary")))
                ->getForm();
        
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            
            if ($form->isValid()) {
                $entityManger->remove($category);
                $entityManger->flush();
                
                 //Set flash message
                $message = $translator->trans('category.delete.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_category'));
            } else {
                $message = $translator->trans('category.delete.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:Category:delete.html.twig", array(
            'form' => $form->createView(),
            'category' => $category
        ));
    }
}