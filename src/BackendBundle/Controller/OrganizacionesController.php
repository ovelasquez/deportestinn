<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\Organizaciones;
use BackendBundle\Form\OrganizacionesType;

/**
 * Organizaciones controller.
 *
 * @Route("/organizaciones")
 */
class OrganizacionesController extends Controller
{
    /**
     * Lists all Organizaciones entities.
     *
     * @Route("/", name="organizaciones_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $organizaciones = $em->getRepository('BackendBundle:Organizaciones')->findAll();

        return $this->render('organizaciones/index.html.twig', array(
            'organizaciones' => $organizaciones,
        ));
    }

    /**
     * Creates a new Organizaciones entity.
     *
     * @Route("/new", name="organizaciones_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $organizacione = new Organizaciones();
        $form = $this->createForm('BackendBundle\Form\OrganizacionesType', $organizacione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organizacione);
            $em->flush();

            return $this->redirectToRoute('organizaciones_show', array('id' => $organizacione->getId()));
        }

        return $this->render('organizaciones/new.html.twig', array(
            'organizacione' => $organizacione,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Organizaciones entity.
     *
     * @Route("/{id}", name="organizaciones_show")
     * @Method("GET")
     */
    public function showAction(Organizaciones $organizacione)
    {
        $deleteForm = $this->createDeleteForm($organizacione);

        return $this->render('organizaciones/show.html.twig', array(
            'organizacione' => $organizacione,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organizaciones entity.
     *
     * @Route("/{id}/edit", name="organizaciones_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Organizaciones $organizacione)
    {
        $deleteForm = $this->createDeleteForm($organizacione);
        $editForm = $this->createForm('BackendBundle\Form\OrganizacionesType', $organizacione);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organizacione);
            $em->flush();

            return $this->redirectToRoute('organizaciones_edit', array('id' => $organizacione->getId()));
        }

        return $this->render('organizaciones/edit.html.twig', array(
            'organizacione' => $organizacione,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Organizaciones entity.
     *
     * @Route("/{id}", name="organizaciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Organizaciones $organizacione)
    {
        $form = $this->createDeleteForm($organizacione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($organizacione);
            $em->flush();
        }

        return $this->redirectToRoute('organizaciones_index');
    }

    /**
     * Creates a form to delete a Organizaciones entity.
     *
     * @param Organizaciones $organizacione The Organizaciones entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Organizaciones $organizacione)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('organizaciones_delete', array('id' => $organizacione->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
