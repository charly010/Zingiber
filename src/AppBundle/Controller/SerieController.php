<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Serie controller.
 *
 */
class SerieController extends Controller
{
    /**
     * Lists all serie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $series = $em->getRepository('AppBundle:Serie')->findAll();

        return $this->render('@App/serie/index.html.twig', array(
            'series' => $series,
        ));
    }

    /**
     * Creates a new serie entity.
     *
     */
    public function newAction(Request $request)
    {
        $serie = new Serie();
        $form = $this->createForm('AppBundle\Form\SerieType', $serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($serie);
            $em->flush();

            return $this->redirectToRoute('serie_show', array('id' => $serie->getId()));
        }

        return $this->render('@App/serie/new.html.twig', array(
            'serie' => $serie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Reads a serie entity.
     *
     */
    public function readAction(Serie $serie, $page)
    {
        $nbPages = $serie->getSketchs()->count();

        if ($nbPages === intval($page)){
            $nextPage = $page;
        }
        else {
            $nextPage = $page + 1;
        }

        $sketch = $this->getDoctrine()->getRepository('AppBundle:Sketch')->findPageFromSerie($serie, $page);

        return $this->render('@App/serie/read.html.twig', array(
            'sketch' => $sketch,
            'nextPage' => $nextPage,
        ));
    }

    /**
     * Finds and displays a serie entity.
     *
     */
    public function showAction(Serie $serie)
    {
        $deleteForm = $this->createDeleteForm($serie);

        return $this->render('@App/serie/show.html.twig', array(
            'serie' => $serie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing serie entity.
     *
     */
    public function editAction(Request $request, Serie $serie)
    {
        $deleteForm = $this->createDeleteForm($serie);
        $editForm = $this->createForm('AppBundle\Form\SerieType', $serie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('serie_edit', array('id' => $serie->getId()));
        }

        return $this->render('@App/serie/edit.html.twig', array(
            'serie' => $serie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a serie entity.
     *
     */
    public function deleteAction(Request $request, Serie $serie)
    {
        $form = $this->createDeleteForm($serie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($serie);
            $em->flush();
        }

        return $this->redirectToRoute('serie_index');
    }

    /**
     * Creates a form to delete a serie entity.
     *
     * @param Serie $serie The serie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Serie $serie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('serie_delete', array('id' => $serie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
