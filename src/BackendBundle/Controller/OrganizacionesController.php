<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BackendBundle\Entity\Organizaciones;
use BackendBundle\Form\OrganizacionesType;
use BackendBundle\Entity\OrganizacionCampeonatoDisciplina;

/**
 * Organizaciones controller.
 *
 * @Route("/organizaciones")
 */
class OrganizacionesController extends Controller {

    /**
     * Lists all Organizaciones entities.
     *
     * @Route("/", name="organizaciones_index")
     * @Method("GET")
     */
    public function indexAction() {
        if (!$this->get('security.context')->isGranted('ROLE_LIGA')) {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }
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
    public function newAction(Request $request) {
        $organizacione = new Organizaciones();
        $form = $this->createForm('BackendBundle\Form\OrganizacionesType', $organizacione);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($organizacione);
            //$em->flush();
            //obtenemos las disciplinas asociadas a la organizacion            
            $disciplinasAsociadas = $request->request->get('disciplinas');

            foreach ($disciplinasAsociadas as &$valor) {
                $organizacionDisciplinas = new OrganizacionCampeonatoDisciplina();
                $disciplina = $em->getRepository('BackendBundle:Disciplinas')->find($valor);
                $organizacionDisciplinas->setDisciplina($disciplina);
                $organizacionDisciplinas->setOrganizacion($organizacione);
                $em->persist($organizacionDisciplinas);
            }
            $em->flush();

            return $this->redirectToRoute('organizaciones_show', array('id' => $organizacione->getId()));
        }


        //Fijamos el Campeonato por Parameters Camp
        //$_CAMP = $this->container->getParameter('camp');
        //Fijamos El Campeonato por el usuario logueado
        $_CAMP = $this->getUser()->getCampeonato();  
        //dump($this->getUser()); die();

        //Buscar todas las disciplinas asociadas al campeonato
        $campeonatoDisciplinas = $em->getRepository('BackendBundle:CampeonatoDisciplina')->findByCampeonato($_CAMP);
       // dump($campeonatoDisciplinas); die();

        return $this->render('organizaciones/new.html.twig', array(
                    'organizacione' => $organizacione,
                    'campeonatoDisciplinas' => $campeonatoDisciplinas,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Organizaciones entity.
     *
     * @Route("/{id}", name="organizaciones_show")
     * @Method("GET")
     */
    public function showAction(Organizaciones $organizacione) {
        $deleteForm = $this->createDeleteForm($organizacione);

        //Buscar todas las disciplinas asociadas a la organizacion en el campeonato
        $em = $this->getDoctrine()->getManager();

        $disciplinas = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findByOrganizacion($organizacione->getId());

        $deportes = array();
        foreach ($disciplinas as &$valor) {
            $disciplina = $em->getRepository('BackendBundle:Disciplinas')->find($valor->getDisciplina()->getId());
            array_push($deportes, $disciplina->getNombre());
        }
        //dump($deportes);die();

        return $this->render('organizaciones/show.html.twig', array(
                    'organizacione' => $organizacione,
                    'disciplinas' => $deportes,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organizaciones entity.
     *
     * @Route("/{id}/edit", name="organizaciones_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Organizaciones $organizacione) {
        $deleteForm = $this->createDeleteForm($organizacione);
        $editForm = $this->createForm('BackendBundle\Form\OrganizacionesType', $organizacione);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em->persist($organizacione);
            //$em->flush();
            //Buscar todas las disciplinas asociadas a la organizacion en el campeonato y las eliminamos                      
            $disciplinas = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findByOrganizacion($organizacione->getId());
            foreach ($disciplinas as &$valor) {
                $em->remove($valor);
            }
            // $em->flush();
            //obtenemos las disciplinas asociadas a la organizacion            
            $disciplinasAsociadas = $request->request->get('disciplinas');

            foreach ($disciplinasAsociadas as &$valor) {
                $organizacionDisciplinas = new OrganizacionCampeonatoDisciplina();
                $disciplina = $em->getRepository('BackendBundle:Disciplinas')->find($valor);
                $organizacionDisciplinas->setDisciplina($disciplina);
                $organizacionDisciplinas->setOrganizacion($organizacione);
                $em->persist($organizacionDisciplinas);
            }
            $em->flush();

            return $this->redirectToRoute('organizaciones_show', array('id' => $organizacione->getId()));
        }

        //Buscar todas las disciplinas asociadas al campeonato
        //Fijamos el Campeonato por Parameters Camp
        // $_CAMP = $this->container->getParameter('camp');
        //Fijamos El Campeonato por el usuario logueado
        $_CAMP = $this->getUser()->getCampeonato();
       // dump($this->getUser());

        $campeonatoDisciplinas = $em->getRepository('BackendBundle:CampeonatoDisciplina')->findByCampeonato($_CAMP);
        dump($campeonatoDisciplinas);  
        //Buscar todas las disciplinas asociadas a la organizacion en el campeonato
        // $em = $this->getDoctrine()->getManager();
        $disciplinas = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findByOrganizacion($organizacione->getId());
        //dump($disciplinas);  

        $deportes = array();

        //comparamos cual de las disciplinas del campeonatos estan asociadas con la organizacion 
        foreach ($campeonatoDisciplinas as &$valor) {
            $chek = 0;
            foreach ($disciplinas as &$k) {
                $disciplina = $em->getRepository('BackendBundle:Disciplinas')->find($k->getDisciplina()->getId());
                // dump($disciplina);
                if ($valor->getDisciplina()->getId() === $disciplina->getId()) {
                    //$deportes(NombreDisciplina,IdDisciplina,1 o 0) -> 1 = si y 0 = no
                    $chek = 1;
                } else {
                    
                }
            }
            array_push($deportes, array($valor->getDisciplina()->getNombre(), $valor->getDisciplina()->getId(), $chek));
        }
        //dump($deportes);  die();

        return $this->render('organizaciones/edit.html.twig', array(
                    'organizacione' => $organizacione,
                    'deportes' => $deportes,
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
    public function deleteAction(Request $request, Organizaciones $organizacione) {
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
    private function createDeleteForm(Organizaciones $organizacione) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('organizaciones_delete', array('id' => $organizacione->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
