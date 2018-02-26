<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $series = $em->getRepository('AppBundle:Serie')->findAll();

        return $this->render('@App/front/index.html.twig', array(
            'series' => $series,
        ));
    }
}