<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\Disciplinas;
use BackendBundle\Form\DisciplinasType;

/**
 * Disciplinas controller.
 *
 * @Route("/disciplinas")
 */
class DisciplinasController extends Controller
{
    /**
     * Lists all Disciplinas entities.
     *
     * @Route("/", name="disciplinas_index")
     * @Method("GET")
     */
    public function indexAction()
    {
          if (!$this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }
        $em = $this->getDoctrine()->getManager();

        $disciplinas = $em->getRepository('BackendBundle:Disciplinas')->findAll();

        return $this->render('disciplinas/index.html.twig', array(
            'disciplinas' => $disciplinas,
        ));
    }

    /**
     * Creates a new Disciplinas entity.
     *
     * @Route("/new", name="disciplinas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $disciplina = new Disciplinas();
        $form = $this->createForm('BackendBundle\Form\DisciplinasType', $disciplina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($disciplina);
            $em->flush();

            return $this->redirectToRoute('disciplinas_show', array('id' => $disciplina->getId()));
        }

        return $this->render('disciplinas/new.html.twig', array(
            'disciplina' => $disciplina,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Disciplinas entity.
     *
     * @Route("/{id}", name="disciplinas_show")
     * @Method("GET")
     */
    public function showAction(Disciplinas $disciplina)
    {
        $deleteForm = $this->createDeleteForm($disciplina);

        return $this->render('disciplinas/show.html.twig', array(
            'disciplina' => $disciplina,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Disciplinas entity.
     *
     * @Route("/{id}/edit", name="disciplinas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Disciplinas $disciplina)
    {
        $deleteForm = $this->createDeleteForm($disciplina);
        $editForm = $this->createForm('BackendBundle\Form\DisciplinasType', $disciplina);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($disciplina);
            $em->flush();

            return $this->redirectToRoute('disciplinas_show', array('id' => $disciplina->getId()));
        }

        return $this->render('disciplinas/edit.html.twig', array(
            'disciplina' => $disciplina,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Disciplinas entity.
     *
     * @Route("/{id}", name="disciplinas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Disciplinas $disciplina)
    {
        $form = $this->createDeleteForm($disciplina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($disciplina);
            $em->flush();
        }

        return $this->redirectToRoute('disciplinas_index');
    }

    /**
     * Creates a form to delete a Disciplinas entity.
     *
     * @param Disciplinas $disciplina The Disciplinas entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Disciplinas $disciplina)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('disciplinas_delete', array('id' => $disciplina->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
