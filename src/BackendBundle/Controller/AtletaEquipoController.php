<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\AtletaEquipo;
use BackendBundle\Form\AtletaEquipoType;

/**
 * AtletaEquipo controller.
 *
 * @Route("/atletaequipo")
 */
class AtletaEquipoController extends Controller
{
    /**
     * Lists all AtletaEquipo entities.
     *
     * @Route("/", name="atletaequipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $atletaEquipos = $em->getRepository('BackendBundle:AtletaEquipo')->findAll();

        return $this->render('atletaequipo/index.html.twig', array(
            'atletaEquipos' => $atletaEquipos,
        ));
    }

    /**
     * Creates a new AtletaEquipo entity.
     *
     * @Route("/new", name="atletaequipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $atletaEquipo = new AtletaEquipo();
        $form = $this->createForm('BackendBundle\Form\AtletaEquipoType', $atletaEquipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atletaEquipo);
            $em->flush();

            return $this->redirectToRoute('atletaequipo_show', array('id' => $atletaEquipo->getId()));
        }

        return $this->render('atletaequipo/new.html.twig', array(
            'atletaEquipo' => $atletaEquipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AtletaEquipo entity.
     *
     * @Route("/{id}", name="atletaequipo_show")
     * @Method("GET")
     */
    public function showAction(AtletaEquipo $atletaEquipo)
    {
        $deleteForm = $this->createDeleteForm($atletaEquipo);

        return $this->render('atletaequipo/show.html.twig', array(
            'atletaEquipo' => $atletaEquipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AtletaEquipo entity.
     *
     * @Route("/{id}/edit", name="atletaequipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, AtletaEquipo $atletaEquipo)
    {
        $deleteForm = $this->createDeleteForm($atletaEquipo);
        $editForm = $this->createForm('BackendBundle\Form\AtletaEquipoType', $atletaEquipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atletaEquipo);
            $em->flush();

            return $this->redirectToRoute('atletaequipo_edit', array('id' => $atletaEquipo->getId()));
        }

        return $this->render('atletaequipo/edit.html.twig', array(
            'atletaEquipo' => $atletaEquipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a AtletaEquipo entity.
     *
     * @Route("/{id}", name="atletaequipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, AtletaEquipo $atletaEquipo)
    {
        $form = $this->createDeleteForm($atletaEquipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($atletaEquipo);
            $em->flush();
        }

        return $this->redirectToRoute('atletaequipo_index');
    }

    /**
     * Creates a form to delete a AtletaEquipo entity.
     *
     * @param AtletaEquipo $atletaEquipo The AtletaEquipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AtletaEquipo $atletaEquipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('atletaequipo_delete', array('id' => $atletaEquipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
