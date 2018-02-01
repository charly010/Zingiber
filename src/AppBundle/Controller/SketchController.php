<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sketch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SketchType;

/**
 * Sketch controller.
 *
 */
class SketchController extends Controller
{
    /**
     * Lists all Sketch entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sketchs = $em->getRepository('AppBundle:Sketch')->findAll();

        return $this->render('@App/sketch/index.html.twig', array(
            'sketchs' => $sketchs,
        ));
    }

    /**
     * Creates a new sketch entity.
     *
     */
    public function newAction(Request $request)
    {
        $sketch = new Sketch();
        $queryBuilder = $this->getDoctrine()->getRepository('AppBundle:Serie')->findAllQB();
        $form = $this->createCreateForm('AppBundle\Form\SketchType', $sketch, $queryBuilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $sketch->getImageFile();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('sketchs_directory'),
                $fileName
            );
            $sketch->setImage($fileName);
            $em->persist($sketch);
            $em->flush();

            return $this->redirectToRoute('sketch_show', array('id' => $sketch->getId()));
        }

        return $this->render('@App/sketch/new.html.twig', array(
            'sketch' => $sketch,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sketch entity.
     *
     */
    public function showAction(Sketch $sketch)
    {
        $deleteForm = $this->createDeleteForm($sketch);

        return $this->render('@App/sketch/show.html.twig', array(
            'sketch' => $sketch,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sketch entity.
     *
     */
    public function editAction(Request $request, Sketch $sketch)
    {
        $deleteForm = $this->createDeleteForm($sketch);
        $queryBuilder = $this->getDoctrine()->getRepository('AppBundle:Serie')->findAllQB();
        $editForm = $this->createEditForm('AppBundle\Form\SketchType', $sketch, $queryBuilder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sketch);
            $em->flush();

            return $this->redirectToRoute('sketch_edit', array('id' => $sketch->getId()));
        }

        return $this->render('@App/sketch/edit.html.twig', array(
            'sketch' => $sketch,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sketch entity.
     *
     */
    public function deleteAction(Request $request, Sketch $sketch)
    {
        $form = $this->createDeleteForm($sketch);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sketch);
            $em->flush();
        }

        return $this->redirectToRoute('sketch_index');
    }

    /**
     * Creates a form to delete a sketch entity.
     *
     * @param Image $sketch The sketch entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sketch $sketch)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sketch_delete', array('id' => $sketch->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function createCreateForm($type, $sketch, $queryBuilder)
    {
        $form = $this->createForm($type, $sketch, [
            'action'        => $this->generateUrl('sketch_new', array('id' => $sketch->getId())),
            'method'        => 'POST',
            '_queryBuilder' => $queryBuilder,
        ]);

        return $form;
    }

    private function createEditForm($type, $sketch, $queryBuilder)
    {
        $form = $this->createForm($type, $sketch, [
            'action'        => $this->generateUrl('sketch_edit', array('id' => $sketch->getId())),
            'method'        => 'POST',
            '_queryBuilder' => $queryBuilder,
        ]);

        return $form;
    }
}
