<?php

namespace MK\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MK\FrontBundle\Form\FilterType;
use MK\FrontBundle\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $formFilter = $this->createForm(new FilterType());
        $resultFilter = array();
        if ($request->isMethod("POST")) {
            $formFilter->bind($request);
            if ($formFilter->isValid()) {
                $dataFilter = $formFilter->getData();
                $entityManger = $this->getDoctrine()->getManager();
                $productRepo = $entityManger->getRepository('MKAdminBundle:Product');
                $resultFilter = $productRepo->getFilterProduct($dataFilter);
            }
        }
        
        return $this->render('MKFrontBundle:Default:index.html.twig', array(
            'formFilter' => $formFilter->createView(),
            'resultFilter' => $resultFilter,
            'request' => $request
        ));
    }
    
    public function searchAction(Request $request)
    {
        $formSearch = $this->createForm(new SearchType());
        $resultSearch = array();
        if ($request->isMethod("POST")) {
            $formSearch->bind($request);
            if ($formSearch->isValid()) {
                $dataFilter = $formSearch->getData();
                $entityManger = $this->getDoctrine()->getManager();
                $productRepo = $entityManger->getRepository('MKAdminBundle:Product');
                $resultSearch = $productRepo->getSearchProduct($dataFilter['keyword']);
            }
        }
        
        return $this->render('MKFrontBundle:Default:search.html.twig', array(
            'formSearch' => $formSearch->createView(),
            'resultSearch' => $resultSearch,
            'request' => $request
        ));
    }
}
