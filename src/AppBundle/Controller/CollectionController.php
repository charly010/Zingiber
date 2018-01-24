<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Collection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Collection controller.
 *
 */
class CollectionController extends Controller
{
    /**
     * Lists all collection entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $collections = $em->getRepository('AppBundle:Collection')->findAll();

        return $this->render('@App/collection/index.html.twig', array(
            'collections' => $collections,
        ));
    }

    /**
     * Creates a new collection entity.
     *
     */
    public function newAction(Request $request)
    {
        $collection = new Collection();
        $form = $this->createForm('AppBundle\Form\CollectionType', $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($collection);
            $em->flush();

            return $this->redirectToRoute('collection_show', array('id' => $collection->getId()));
        }

        return $this->render('@App/collection/new.html.twig', array(
            'collection' => $collection,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a collection entity.
     *
     */
    public function showAction(Collection $collection)
    {
        $deleteForm = $this->createDeleteForm($collection);

        return $this->render('@App/collection/show.html.twig', array(
            'collection' => $collection,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing collection entity.
     *
     */
    public function editAction(Request $request, Collection $collection)
    {
        $deleteForm = $this->createDeleteForm($collection);
        $editForm = $this->createForm('AppBundle\Form\CollectionType', $collection);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('collection_edit', array('id' => $collection->getId()));
        }

        return $this->render('@App/collection/edit.html.twig', array(
            'collection' => $collection,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a collection entity.
     *
     */
    public function deleteAction(Request $request, Collection $collection)
    {
        $form = $this->createDeleteForm($collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($collection);
            $em->flush();
        }

        return $this->redirectToRoute('collection_index');
    }

    /**
     * Creates a form to delete a collection entity.
     *
     * @param Collection $collection The collection entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Collection $collection)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('collection_delete', array('id' => $collection->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
