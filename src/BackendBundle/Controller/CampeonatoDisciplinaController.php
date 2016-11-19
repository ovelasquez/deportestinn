<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\CampeonatoDisciplina;
use BackendBundle\Form\CampeonatoDisciplinaType;

/**
 * CampeonatoDisciplina controller.
 *
 * @Route("/campeonatodisciplina")
 */
class CampeonatoDisciplinaController extends Controller {

    /**
     * Lists all CampeonatoDisciplina entities.
     *
     * @Route("/", name="campeonatodisciplina_index")
     * @Method("GET")
     */
    public function indexAction() {
          if (!$this->get('security.context')->isGranted('ROLE_LIGA')) {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }
        $em = $this->getDoctrine()->getManager();

        $campeonatoDisciplinas = $em->getRepository('BackendBundle:CampeonatoDisciplina')->findAll();

        return $this->render('campeonatodisciplina/index.html.twig', array(
                    'campeonatoDisciplinas' => $campeonatoDisciplinas,
        ));
    }

    /**
     * Creates a new CampeonatoDisciplina entity.
     *
     * @Route("/new", name="campeonatodisciplina_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $porciones = explode("-", $request->request->get('datefilter'));
        $campeonatoDisciplina = new CampeonatoDisciplina();
        //Si va a editar armamos la variable periodo para mostarlo en la vista         

        $form = $this->createForm('BackendBundle\Form\CampeonatoDisciplinaType', $campeonatoDisciplina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campeonatoDisciplina->setInicio(new \DateTime(trim($porciones[0])));
            $campeonatoDisciplina->setFin(new \DateTime(trim($porciones[1])));

            $em = $this->getDoctrine()->getManager();
            $em->persist($campeonatoDisciplina);
            $em->flush();

            return $this->redirectToRoute('campeonatodisciplina_show', array('id' => $campeonatoDisciplina->getId()));
        }

        return $this->render('campeonatodisciplina/new.html.twig', array(
                    'campeonatoDisciplina' => $campeonatoDisciplina,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CampeonatoDisciplina entity.
     *
     * @Route("/{id}", name="campeonatodisciplina_show")
     * @Method("GET")
     */
    public function showAction(CampeonatoDisciplina $campeonatoDisciplina) {
        $deleteForm = $this->createDeleteForm($campeonatoDisciplina);

        return $this->render('campeonatodisciplina/show.html.twig', array(
                    'campeonatoDisciplina' => $campeonatoDisciplina,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CampeonatoDisciplina entity.
     *
     * @Route("/{id}/edit", name="campeonatodisciplina_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CampeonatoDisciplina $campeonatoDisciplina) {
        $deleteForm = $this->createDeleteForm($campeonatoDisciplina);
        $editForm = $this->createForm('BackendBundle\Form\CampeonatoDisciplinaType', $campeonatoDisciplina);
        $editForm->handleRequest($request);

        //Si va a editar armamos la variable periodo para mostarlo en la vista         
        $periodo = ($campeonatoDisciplina->getInicio()->format("m/d/Y")) . "-" . ($campeonatoDisciplina->getFin()->format("m/d/Y"));

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $porciones = explode("-", $request->request->get('datefilter'));
            $campeonatoDisciplina->setInicio(new \DateTime(trim($porciones[0])));
            $campeonatoDisciplina->setFin(new \DateTime(trim($porciones[1])));

            $em = $this->getDoctrine()->getManager();
            $em->persist($campeonatoDisciplina);
            $em->flush();

            return $this->redirectToRoute('campeonatodisciplina_show', array('id' => $campeonatoDisciplina->getId()));            
        }
        //dump($editForm->createView()); die;

        return $this->render('campeonatodisciplina/edit.html.twig', array(
                    'campeonatoDisciplina' => $campeonatoDisciplina,
                    'periodo' => $periodo,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CampeonatoDisciplina entity.
     *
     * @Route("/{id}", name="campeonatodisciplina_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CampeonatoDisciplina $campeonatoDisciplina) {
        $form = $this->createDeleteForm($campeonatoDisciplina);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($campeonatoDisciplina);
            $em->flush();
        }

        return $this->redirectToRoute('campeonatodisciplina_index');
    }

    /**
     * Creates a form to delete a CampeonatoDisciplina entity.
     *
     * @param CampeonatoDisciplina $campeonatoDisciplina The CampeonatoDisciplina entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CampeonatoDisciplina $campeonatoDisciplina) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('campeonatodisciplina_delete', array('id' => $campeonatoDisciplina->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
