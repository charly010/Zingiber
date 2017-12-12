<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{
    public function indexAction()
    {
        return $this->render('@App/Front/index.html.twig');
    }
}