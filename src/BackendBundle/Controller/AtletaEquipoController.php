<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\AtletaEquipo;
use BackendBundle\Form\AtletaEquipoType;
use BackendBundle\Entity\CampeonatoDisciplina;

/**
 * AtletaEquipo controller.
 *
 * @Route("/atletaequipo")
 */
class AtletaEquipoController extends Controller {

    /**
     * Lists all AtletaEquipo entities.
     *
     * @Route("/", name="atletaequipo_index")
     * @Method("GET")
     */
    public function indexAction() {
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
    public function newAction(Request $request) {
        $atletaEquipo = new AtletaEquipo();
        $form = $this->createForm('BackendBundle\Form\AtletaEquipoType', $atletaEquipo);
        $form->handleRequest($request);
         $problema = "";
        if ($form->isSubmitted()) {
           
            $em = $this->getDoctrine()->getManager();
            //  = ($request->request->get('atleta_equipo')['equipo']);
            //Equipo y Organizacion al cual va a registrarse el atleta

            $equipo = $em->getRepository('BackendBundle:Equipos')->find($request->request->get('atleta_equipo')['equipo']);
            $disciplina = $equipo->getEquipoOrganizacionCampeonatoDisciplina()->getDisciplina();
            $organizacion = $equipo->getEquipoOrganizacionCampeonatoDisciplina()->getOrganizacion();
            $campeonato = $equipo->getEquipoOrganizacionCampeonatoDisciplina()->getOrganizacion()->getCampeonato();
            //Informacion de la disiciplina en el campeonato: Max, Min, Fecha de inicio y de fin
            $campeonatoDisciplina = new CampeonatoDisciplina();
            $campeonatoDisciplina = $em->getRepository('BackendBundle:CampeonatoDisciplina')->findOneBy(array('disciplina' => $disciplina, 'campeonato' => $campeonato));

            //Verificamos si estamos dentro del rango permitido.
            $inicio = $campeonatoDisciplina->getInicio();
            $fin = $campeonatoDisciplina->getFin();
            $hoy = new \DateTime('now');

            //Si esta dentro del rango
            if (($hoy >= $inicio) && ($hoy <= $fin)) {
                //Verificamos sino estamos por encima del máx
                $max = $campeonatoDisciplina->getMaximo();
                $min = $campeonatoDisciplina->getMinimo();
                $registrados = $em->getRepository('BackendBundle:AtletaEquipo')->findAll(array('equipo' => $equipo));
                // echo count($registrados);  die();
                if ($max > count($registrados)) {
                    if ($form->isSubmitted() && $form->isValid()) {
                        $em->persist($atletaEquipo);
                        $em->flush();
                        return $this->redirectToRoute('atletaequipo_show', array('id' => $atletaEquipo->getId()));
                    }
                } else {
                    $problema = "El número Máximo de Atleta ya fue Registrado";
                }
            } else {
                $problema = "Inscripción Fuera de Fecha";
            }
        }

        return $this->render('atletaequipo/new.html.twig', array(
                    'atletaEquipo' => $atletaEquipo,
                    'problema' => $problema,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AtletaEquipo entity.
     *
     * @Route("/{id}", name="atletaequipo_show")
     * @Method("GET")
     */
    public function showAction(AtletaEquipo $atletaEquipo) {
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
    public function editAction(Request $request, AtletaEquipo $atletaEquipo) {
        $deleteForm = $this->createDeleteForm($atletaEquipo);
        $editForm = $this->createForm('BackendBundle\Form\AtletaEquipoType', $atletaEquipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($atletaEquipo);
            $em->flush();


            return $this->redirectToRoute('atletaequipo_show', array('id' => $atletaEquipo->getId()));

// return $this->redirectToRoute('atletaequipo_edit', array('id' => $atletaEquipo->getId()));
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
    public function deleteAction(Request $request, AtletaEquipo $atletaEquipo) {
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
    private function createDeleteForm(AtletaEquipo $atletaEquipo) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('atletaequipo_delete', array('id' => $atletaEquipo->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
