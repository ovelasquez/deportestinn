<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Campeonatos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Campeonato controller.
 *
 * @Route("campeonatos")
 */
class CampeonatosController extends Controller {

    /**
     * Lists all campeonato entities.
     *
     * @Route("/", name="campeonatos_index")
     * @Method("GET")
     */
    public function indexAction() {
          if (!$this->get('security.context')->isGranted('ROLE_LIGA')) {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }
       // $user = $this->getUser();  dump($user);     die();
        $em = $this->getDoctrine()->getManager();

        $campeonatos = $em->getRepository('BackendBundle:Campeonatos')->findAll();

        return $this->render('campeonatos/index.html.twig', array(
                    'campeonatos' => $campeonatos,
        ));
    }

    /**
     * Creates a new campeonato entity.
     *
     * @Route("/new", name="campeonatos_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $porciones = explode("-", $request->request->get('datefilter'));

        $campeonato = new Campeonatos();

        $form = $this->createForm('BackendBundle\Form\CampeonatosType', $campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campeonato->setInicio(new \DateTime(trim($porciones[0])));
            $campeonato->setFin(new \DateTime(trim($porciones[1])));
            $em = $this->getDoctrine()->getManager();
            $em->persist($campeonato);
            $em->flush($campeonato);

            return $this->redirectToRoute('campeonatos_show', array('id' => $campeonato->getId()));
        }

        return $this->render('campeonatos/new.html.twig', array(
                    'campeonato' => $campeonato,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a campeonato entity.
     *
     * @Route("/{id}", name="campeonatos_show")
     * @Method("GET")
     */
    public function showAction(Campeonatos $campeonato) {
        $deleteForm = $this->createDeleteForm($campeonato);

        return $this->render('campeonatos/show.html.twig', array(
                    'campeonato' => $campeonato,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing campeonato entity.
     *
     * @Route("/{id}/edit", name="campeonatos_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Campeonatos $campeonato) {
        //Si va a editar armamos la variable periodo para mostarlo en la vista         
        $periodo = ($campeonato->getInicio()->format("m/d/Y")) . "-" . ($campeonato->getFin()->format("m/d/Y"));

        $deleteForm = $this->createDeleteForm($campeonato);
        $editForm = $this->createForm('BackendBundle\Form\CampeonatosType', $campeonato);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            //Si vamos a almacenar en la BD tratamos a porciones y las asignamos  a las respectivas fechas
            $porciones = explode("-", $request->request->get('datefilter'));
            $campeonato->setInicio(new \DateTime(trim($porciones[0])));
            $campeonato->setFin(new \DateTime(trim($porciones[1])));

            $em = $this->getDoctrine()->getManager();
            $em->persist($campeonato);
            $em->flush();

            return $this->redirectToRoute('campeonatos_show', array('id' => $campeonato->getId()));
        }

        return $this->render('campeonatos/edit.html.twig', array(
                    'campeonato' => $campeonato,
                    'periodo' => $periodo,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a campeonato entity.
     *
     * @Route("/{id}", name="campeonatos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Campeonatos $campeonato) {
        $form = $this->createDeleteForm($campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($campeonato);
            $em->flush($campeonato);
        }

        return $this->redirectToRoute('campeonatos_index');
    }

    /**
     * Creates a form to delete a campeonato entity.
     *
     * @param Campeonatos $campeonato The campeonato entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Campeonatos $campeonato) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('campeonatos_delete', array('id' => $campeonato->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
