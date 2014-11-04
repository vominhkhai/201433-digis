<?php

namespace MK\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MKAdminBundle:Default:index.html.twig');
    }
}
