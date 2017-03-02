<?php

namespace VouchedFor\TokenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VouchedForTokenBundle:Default:index.html.twig');
    }
}
