<?php

namespace MK\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MK\AdminBundle\Entity\ProductColor;
use MK\AdminBundle\Form\ProductColorType;

class ProductColorController extends Controller
{
    public function indexAction()
    {
        $entityManger = $this->getDoctrine()->getManager();
        $productColorRepo = $entityManger->getRepository('MKAdminBundle:ProductColor');
        $listProductColor = $productColorRepo->findAll();
 
        return $this->render('MKAdminBundle:ProductColor:index.html.twig', array(
            'listProductColor' => $listProductColor
        ));
    }
    
    public function addAction(Request $request, $productColorId = null)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $productColorRepo = $entityManger->getRepository('MKAdminBundle:ProductColor');
        $translator = $this->get('translator');
        
        if ($productColorId === null) {
            $productColor = new ProductColor();
            $formAction = $this->generateUrl('mk_admin_product_color_add');
            $typeAction = "add";
            $titleBreadcum = $translator->trans('product.color.add', array(), 'admin_messages');
        } else {
            $productColor = $productColorRepo->find($productColorId);
            $formAction = $this->generateUrl('mk_admin_product_color_edit', array('productColorId' => $productColor->getId()));
            $typeAction = "edit";
            $titleBreadcum = $translator->trans('product.color.edit', array(), 'admin_messages');
        }
        
        $form = $this->createForm(new ProductColorType(), $productColor);
        
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            if ($form->isValid()) {
                $entityManger->persist($productColor);
                $entityManger->flush();
                //Set flash message
                $message = $translator->trans('product.color.form.create.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_product_color'));
            } else {
                $message = $translator->trans('product.color.form.create.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:ProductColor:form.html.twig", array(
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