<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\Atletas;
use BackendBundle\Form\AtletasType;

/**
 * Atletas controller.
 *
 * @Route("/atletas")
 */
class AtletasController extends Controller
{
    /**
     * Lists all Atletas entities.
     *
     * @Route("/", name="atletas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $atletas = $em->getRepository('BackendBundle:Atletas')->findAll();

        return $this->render('atletas/index.html.twig', array(
            'atletas' => $atletas,
        ));
    }

    /**
     * Creates a new Atletas entity.
     *
     * @Route("/new", name="atletas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $atleta = new Atletas();
        $form = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atleta);
            $em->flush();

            return $this->redirectToRoute('atletas_show', array('id' => $atleta->getId()));
        }

        return $this->render('atletas/new.html.twig', array(
            'atleta' => $atleta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Atletas entity.
     *
     * @Route("/{id}", name="atletas_show")
     * @Method("GET")
     */
    public function showAction(Atletas $atleta)
    {
        $deleteForm = $this->createDeleteForm($atleta);

        return $this->render('atletas/show.html.twig', array(
            'atleta' => $atleta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Atletas entity.
     *
     * @Route("/{id}/edit", name="atletas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Atletas $atleta)
    {
        $deleteForm = $this->createDeleteForm($atleta);
        $editForm = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atleta);
            $em->flush();

            return $this->redirectToRoute('atletas_edit', array('id' => $atleta->getId()));
        }

        return $this->render('atletas/edit.html.twig', array(
            'atleta' => $atleta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Atletas entity.
     *
     * @Route("/{id}", name="atletas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Atletas $atleta)
    {
        $form = $this->createDeleteForm($atleta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($atleta);
            $em->flush();
        }

        return $this->redirectToRoute('atletas_index');
    }

    /**
     * Creates a form to delete a Atletas entity.
     *
     * @param Atletas $atleta The Atletas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Atletas $atleta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('atletas_delete', array('id' => $atleta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
