<?php

namespace MK\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MK\AdminBundle\Entity\Product;
use MK\AdminBundle\Form\ProductType;

class ProductController extends Controller
{
    public function indexAction()
    {
        $entityManger = $this->getDoctrine()->getManager();
        $productRepo = $entityManger->getRepository('MKAdminBundle:Product');
        $listProduct = $productRepo->findAll();
        $totalProduct = $productRepo->getTotal();
 
        return $this->render('MKAdminBundle:Product:index.html.twig', array(
            'listProduct' => $productRepo->findAll()
        ));
    }
    
    public function addAction(Request $request, $productId = null)
    {
        $entityManger = $this->getDoctrine()->getManager();
        $productRepo = $entityManger->getRepository('MKAdminBundle:Product');
        $translator = $this->get('translator');

        if ($productId === null) {
            $product = new Product();
            $formAction = $this->generateUrl('mk_admin_product_add');
            $typeAction = "add";
            $titleBreadcum = $translator->trans('product.add', array(), 'admin_messages');
        } else {
            $product = $productRepo->find($productId);
            $formAction = $this->generateUrl('mk_admin_product_edit', array('productId' => $product->getId()));
            $typeAction = "edit";
            $titleBreadcum = $translator->trans('product.edit', array(), 'admin_messages');
        }
        
        $form = $this->createForm(new ProductType(), $product);
        
        if ($request->getMethod() == "POST") {
            $form->bind($request);
            if ($form->isValid()) {
                $entityManger->persist($product);
                $entityManger->flush();
                //Set flash message
                $message = $translator->trans('form.product.create.success', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('success', $message);
                
                return $this->redirect($this->generateUrl('mk_admin_product'));
            } else {
                $message = $translator->trans('form.product.create.error', array(), 'MKAdminBundle');
                $this->get('session')->getFlashBag()->add('error', $message);
            }
        }
        
        return $this->render("MKAdminBundle:Product:form.html.twig", array(
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
                $message = $translator->trans('form.product.delete.success', array(), 'MKAdminBundle');
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