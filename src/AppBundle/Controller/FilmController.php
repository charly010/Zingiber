<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\FilmType;

/**
 * Film controller.
 *
 */
class FilmController extends Controller
{
    /**
     * Lists all Film entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $films = $em->getRepository('AppBundle:Film')->findAll();

        return $this->render('@App/film/index.html.twig', array(
            'films' => $films,
        ));
    }

    /**
     * Creates a new film entity.
     *
     */
    public function newAction(Request $request)
    {
        $film = new Film();
        $queryBuilder = $this->getDoctrine()->getRepository('AppBundle:Categorie')->findAllQB();
        $form = $this->createCreateForm('AppBundle\Form\FilmType', $film, $queryBuilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // appeller le service
            $this->get('app.service.filmcount')->count($film, true);
            

            dump($film); die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('film_show', array('id' => $film->getId()));
        }

        return $this->render('@App/film/new.html.twig', array(
            'film' => $film,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a film entity.
     *
     */
    public function showAction(Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);

        return $this->render('@App/film/show.html.twig', array(
            'film' => $film,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing film entity.
     *
     */
    public function editAction(Request $request, film $film)
    {
        $deleteForm = $this->createDeleteForm($film);
        $queryBuilder = $this->getDoctrine()->getRepository('AppBundle:Categorie')->findAllQB();
        $editForm = $this->createEditForm('AppBundle\Form\FilmType', $film, $queryBuilder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($film);
            $em->flush();

            return $this->redirectToRoute('film_edit', array('id' => $film->getId()));
        }

        return $this->render('@App/film/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a film entity.
     *
     */
    public function deleteAction(Request $request, Film $film)
    {
        $form = $this->createDeleteForm($film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();
        }

        return $this->redirectToRoute('film_index');
    }

    /**
     * Creates a form to delete a film entity.
     *
     * @param Image $film The film entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Film $film)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('film_delete', array('id' => $film->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function createCreateForm($type, $film, $queryBuilder)
    {
        $form = $this->createForm($type, $film, [
            'action'        => $this->generateUrl('film_new', array('id' => $film->getId())),
            'method'        => 'POST',
            '_queryBuilder' => $queryBuilder,
        ]);

        return $form;
    }

    private function createEditForm($type, $film, $queryBuilder)
    {
        $form = $this->createForm($type, $film, [
            'action'        => $this->generateUrl('film_edit', array('id' => $film->getId())),
            'method'        => 'POST',
            '_queryBuilder' => $queryBuilder,
        ]);

        return $form;
    }
}
