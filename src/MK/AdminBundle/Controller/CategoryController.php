<?php

namespace MK\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MK\AdminBundle\Entity\ProductColor;
use MK\AdminBundle\Form\ProductColorType;

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
        
        if ($categoryId === null) {
            $category = new ProductColor();
            $formAction = $this->generateUrl('mk_admin_category_add');
            $typeAction = "add";
        } else {
            $category = $categoryRepo->find($categoryId);
            $formAction = $this->generateUrl('mk_admin_category_edit', array('$categoryId' => $category->getId()));
            $typeAction = "edit";
        }
        
        $form = $this->createForm(new ProductColorType(), $category);
        $translator = $this->get('translator');
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            if ($form->isValid()) {
                $entityManger->persist($category);
                $entityManger->flush();
                //Set flash message
                $message = $translator->trans('category.form.create.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_category_color'));
            } else {
                $message = $translator->trans('category.form.create.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:Category:form.html.twig", array(
            'form' => $form->createView(),
            'formAction' => $formAction
        ));
    }
    
    /**
     * delete one product
     * 
     * @param Request $request
     * @param Integer $productId
     * 
     */
    public function deleteAction(Request $request, $productColorId)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $productRepo = $entityManger->getRepository('MKAdminBundle:ProductColor');
        $productColor = $productRepo->find($productColorId);
        $translator = $this->get('translator');
        $form = $this->createFormBuilder()
                ->add('delete', 'submit', array("attr" => array('class' => "btn btn-primary")))
                ->getForm();
        
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            
            if ($form->isValid()) {
                $entityManger->remove($productColor);
                $entityManger->flush();
                
                 //Set flash message
                $message = $translator->trans('product.color.delete.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_product_color'));
            } else {
                $message = $translator->trans('product.color.delete.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:ProductColor:delete.html.twig", array(
            'form' => $form->createView(),
            'productColor' => $productColor
        ));
    }
}