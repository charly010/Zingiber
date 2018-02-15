<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{
    public function indexAction()
    {
        $adminEmail = $this->container->getParameter('admin_email');
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('AppBundle:Film')->findAll();
        $general = $em->getRepository('AppBundle:General')->findAll()[0];

        if (!empty($general)) {
            $nbFilms = $general->getNbFilms();
        }
        else {
            $nbFilms = 0;
        }

        return $this->render('@App/film/index.html.twig', array(
            'films' => $films,
            'admin_email' => $adminEmail,
            'nb_films' => $nbFilms,
        ));
    }
}