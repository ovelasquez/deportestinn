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
class AtletasController extends Controller {

    /**
     * Lists all Atletas entities.
     *
     * @Route("/", name="atletas_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        $organizacion = '';

        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            $atletas = $em->getRepository('BackendBundle:Atletas')->findAll();
        } elseif ($this->get('security.context')->isGranted('ROLE_LIGA')) {
            $atletas = $em->getRepository('BackendBundle:Atletas')->findAllByLiga($user->getLiga());
        } elseif ($this->get('security.context')->isGranted('ROLE_ORGANIZACION')) {
            $atletas = $em->getRepository('BackendBundle:Atletas')->findAllByOrganizacion($user->getOrganizacion());
            $organizacion = $em->getRepository('BackendBundle:Organizaciones')->find($this->getUser()->getOrganizacion());
        } else {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }

        return $this->render('atletas/index.html.twig', array(
                    'atletas' => $atletas,
                    'organizacion' => $organizacion,
        ));
    }

    /**
     * Creates a new Atletas entity.
     *
     * @Route("/new", name="atletas_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        //dump($request); die;
        //dump($form); die;
        $problema = "";
        $organizacion = '';

        $em = $this->getDoctrine()->getManager();

        //Fijamos La Organización por el usuario logueado, especificamente para el caso de las orgazizaciones
        // no aplica a administradores ni ligas
        $_ORG = $this->getUser()->getOrganizacion();
        if ($_ORG != Null) {
            $organizacion = $em->getRepository('BackendBundle:Organizaciones')->find($this->getUser()->getOrganizacion());
        }

        //dump($this->getUser()); die;
        //Disciplinas en la que va a participar cada organizacion
        $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findBy(array("organizacion" => $_ORG), array('disciplina' => 'DESC'));

        //Buscamos todos los equipos asociados a las diferentes disciplinas donde va a participar
        if (count($disciplinasOrg) > 0):
            $idsD = array();
            $idsDb = array();

            foreach ($disciplinasOrg as $disc) {
                $idsD[$disc->getId()] = array($disc->getDisciplina()->getId(), $disc->getDisciplina()->getNombre(), array());
                array_push($idsDb, $disc->getId());
            }

            $equipos = $em->getRepository('BackendBundle:Equipos')->findAllByDisciplina($idsDb);

            foreach ($equipos as $equipo) {
                array_push($idsD[$equipo->getEquipoOrganizacionCampeonatoDisciplina()->getId()][2], array($equipo->getId(), $equipo->getNombre()));
            }

        endif;

        $atleta = new Atletas();
        $form = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($atleta);
            $em->flush();

            //obtenemos los equipos asociadas a la organizacion            
            $eqAsociados = $request->request->get('equipos');

            foreach ($eqAsociados as $eq) {
                $at_eq = new \BackendBundle\Entity\AtletaEquipo();
                $e = $em->getRepository('BackendBundle:Equipos')->find($eq);
                $at_eq->setAtleta($atleta);
                $at_eq->setEquipo($e);

                $em->persist($at_eq);
                $em->flush();
            }

            return $this->redirectToRoute('atletas_show', array('id' => $atleta->getId()));
        }

        return $this->render('atletas/new.html.twig', array(
                    'atleta' => $atleta,
                    'form' => $form->createView(),
                    'problema' => $problema,
                    'disciplinas' => $idsD,
                    'jsonEq' => json_encode($idsD),
                    'org' => $_ORG,
                    'organizacion' => $organizacion,
        ));
    }

    /**
     * Finds and displays a Atletas entity.
     *
     * @Route("/{id}", name="atletas_show")
     * @Method("GET")
     */
    public function showAction(Atletas $atleta) {
        $deleteForm = $this->createDeleteForm($atleta);
        $organizacion = '';
        $em = $this->getDoctrine()->getManager();

        //Fijamos La Organización por el usuario logueado, especificamente para el caso de las orgazizaciones
        // no aplica a administradores ni ligas
        $_ORG = $this->getUser()->getOrganizacion();
        if ($_ORG != Null) {

            $organizacion = $em->getRepository('BackendBundle:Organizaciones')->find($this->getUser()->getOrganizacion());
        }


        $aEq = $em->getRepository('BackendBundle:AtletaEquipo')->findBy(array("atleta" => $atleta->getId()));
        //dump($aEq[0]->getEquipo()->getEquipoOrganizacionCampeonatoDisciplina()->getDisciplina()); die;

        return $this->render('atletas/show.html.twig', array(
                    'atleta' => $atleta,
                    'delete_form' => $deleteForm->createView(),
                    'atleta_eq' => $aEq,
                    'organizacion' => $organizacion,
        ));
    }

    /**
     * Displays a form to edit an existing Atletas entity.
     *
     * @Route("/{id}/edit", name="atletas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Atletas $atleta) {
        //dump($request);  dump($atleta);        die();
        $deleteForm = $this->createDeleteForm($atleta);
        
        $editForm = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $aEq = $em->getRepository('BackendBundle:AtletaEquipo')->findBy(array("atleta" => $atleta->getId()));

        $organizacion = '';
        //Fijamos La Organización por el usuario logueado, especificamente para el caso de las orgazizaciones
        // no aplica a administradores ni ligas
        $_ORG = $this->getUser()->getOrganizacion();
        if ($_ORG != Null) {
            $organizacion = $em->getRepository('BackendBundle:Organizaciones')->find($this->getUser()->getOrganizacion());
        }

        $idsD = array();
        $idsDb = array();

        //var_dump(empty($_ORG)); die();

        if (!empty($_ORG)):
            $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findBy(array("organizacion" => $_ORG), array('disciplina' => 'DESC'));

        else:
            $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findAll();

        endif;

        if (count($disciplinasOrg) > 0):
            $idsD = array();
            $idsDb = array();

            foreach ($disciplinasOrg as $disc) {
                $idsD[$disc->getId()] = array($disc->getDisciplina()->getId(), $disc->getDisciplina()->getNombre(), array());

                array_push($idsDb, $disc->getId());
            }

            $equipos = $em->getRepository('BackendBundle:Equipos')->findAllByDisciplina($idsDb);


            foreach ($equipos as $equipo) {
                $act = 0;
                foreach ($aEq as $ae) {
                    if ($ae->getEquipo()->getId() === $equipo->getId()) {
                        $act = 1;
                    }
                }
                array_push($idsD[$equipo->getEquipoOrganizacionCampeonatoDisciplina()->getId()][2], array($equipo->getId(), $equipo->getNombre(), $act));
            }

        endif;


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $atleta->setActualizacion(new \DateTime("now"));                    

           // dump($atleta); die();
            $em->persist($atleta);
            $em->flush();

            //obtenemos los equipos asociadas a la organizacion            
            $eqAsociados = $request->request->get('equipos');

            $rEAEx = array();
            foreach ($aEq as $ae) {
                array_push($rEAEx, $ae->getEquipo()->getId());
            }

            foreach ($eqAsociados as $eq) {
                if (!in_array($eq, $rEAEx)):
                    $at_eq = new \BackendBundle\Entity\AtletaEquipo();
                    $e = $em->getRepository('BackendBundle:Equipos')->find($eq);
                    $at_eq->setAtleta($atleta);
                    $at_eq->setEquipo($e);
                    $em->persist($at_eq);
                    $em->flush();
                else:
                    $clave = array_search($eq, $rEAEx);  // $clave = 1;
                    array_splice($rEAEx, $clave, 1);
                endif;
            }

            foreach ($aEq as $ae) {
                if (in_array($ae->getEquipo()->getId(), $rEAEx)):
                    $em->remove($ae);
                    $em->flush();
                endif;
            }



            return $this->redirectToRoute('atletas_show', array('id' => $atleta->getId()));
        }

        return $this->render('atletas/edit.html.twig', array(
                    'atleta' => $atleta,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'atleta_eq' => $aEq,
                    'disciplinas' => $idsD,
                    'jsonEq' => json_encode($idsD),
                    'organizacion' => $organizacion,
        ));
    }

    /**
     * Deletes a Atletas entity.
     *
     * @Route("/{id}", name="atletas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Atletas $atleta) {
        $form = $this->createDeleteForm($atleta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //Obtenemos la Fotografia
            $file = $atleta->getFotografia();
            if ((is_file($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_foto_directory') . '/' . $file))):
                unlink($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_foto_directory') . '/' . $file);
            endif;
            //Obtenemos la Imagen Cedula
            $file = $atleta->getImagenCedula();
            if ((is_file($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_cedula_directory') . '/' . $file))):
                unlink($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_cedula_directory') . '/' . $file);
            endif;

            //Obtenemos la Constancia de Estudio
            $file = $atleta->getContancia();
            if ((is_file($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_constancia_directory') . '/' . $file))):
                unlink($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_constancia_directory') . '/' . $file);
            endif;

            //Obtenemos la Carnet
            $file = $atleta->getCarnet();
            if ((is_file($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_carnet_directory') . '/' . $file))):
                unlink($this->container->getParameter('uploads_directory') . $this->container->getParameter('atletas_carnet_directory') . '/' . $file);
            endif;

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
    private function createDeleteForm(Atletas $atleta) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('atletas_delete', array('id' => $atleta->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
