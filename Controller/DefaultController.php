<?php

namespace ahmadsajid1989\ZammadApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ZammadApiBundle:Default:index.html.twig');
    }
}
