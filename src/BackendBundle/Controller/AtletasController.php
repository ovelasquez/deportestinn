<?php

namespace BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
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
        $problema = array();
        $organizacion = '';
        $idsD = array();
        $idsDb = array();
        $guardo = false;

        $em = $this->getDoctrine()->getManager();
        //Fijamos La Organización por el usuario logueado, especificamente para el caso de las orgazizaciones no aplica a administradores ni ligas
        $_ORG = $this->getUser()->getOrganizacion();
        if ($_ORG != Null) {
            $organizacion = $em->getRepository('BackendBundle:Organizaciones')->find($this->getUser()->getOrganizacion());

            //Disciplinas en la que va a participar cada organizacion
            $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findBy(array("organizacion" => $_ORG), array('disciplina' => 'DESC'));

            //Buscamos todos los equipos asociados a las diferentes disciplinas donde va a participar
            if (count($disciplinasOrg) > 0):
                foreach ($disciplinasOrg as $disc) {
                    $idsD[$disc->getId()] = array($disc->getDisciplina()->getId(), $disc->getDisciplina()->getNombre(), array());
                    array_push($idsDb, $disc->getId());
                }
                $equipos = $em->getRepository('BackendBundle:Equipos')->findAllByDisciplina($idsDb);
                foreach ($equipos as $equipo) {
                    array_push($idsD[$equipo->getEquipoOrganizacionCampeonatoDisciplina()->getId()][2], array($equipo->getId(), $equipo->getNombre()));
                }
            endif;
        }

        $atleta = new Atletas();
        $form = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Buscamos las disciplinas/equipos donde desea participar
            $equipo = array();
            foreach ($request->request->get('equipos') as $valor) {
                array_push($equipo, $em->getRepository('BackendBundle:Equipos')->find($valor));
            }

            //Buscamos los valores de la fecha de inicio y de fin, asi como el valor de la nomina abierta de las  disciplinas donde desea participar
            $campeonatoDisciplina = array();
            foreach ($equipo as $valor) {
                array_push($campeonatoDisciplina, $em->getRepository('BackendBundle:CampeonatoDisciplina')->findOneBy(array('disciplina' => $valor->getEquipoOrganizacionCampeonatoDisciplina()->getDisciplina(), 'campeonato' => $valor->getEquipoOrganizacionCampeonatoDisciplina()->getOrganizacion()->getCampeonato()->getId())));
            }

            $i = 0;
            foreach ($campeonatoDisciplina as $valor) {
                //Verificamos si estamos dentro del rango de fecha permitido para la inscripcion
                $inicio = $valor->getInicio();
                $fin = $valor->getFin();
                $hoy = new \DateTime('now');

                //Si esta dentro del rango
                if (($hoy >= $inicio) && ($hoy <= $fin)) {
                    //Verificamos sino estamos por encima del máx de atletas de la Nomina Abierta
                    $nominaAbierta = $valor->getAbierto();
                    //Buscamos la cantidad de atletas registrados
                    $registrados = $em->getRepository('BackendBundle:AtletaEquipo')->findByEquipo(array('equipo' => $equipo[$i]->getId()));

                    $cantidadAtletas = 0;
                    foreach ($registrados as $reg) {
                        if ($this->getUser()->getOrganizacion() == $reg->getEquipo()->getEquipoOrganizacionCampeonatoDisciplina()->getOrganizacion()->getId()) {
                            $cantidadAtletas++;
                        }
                    }
                    if ($nominaAbierta > $cantidadAtletas) {
                        if (!$guardo) {

                            //Guardar Constacia
                            $file = $atleta->getContancia();
                            $fileName = $this->get('app.file_uploader_constancia')->upload($file);
                            $atleta->setContancia($fileName);

                            //Atleta persist
                            $em->persist($atleta);
                            $guardo = true;
                        }
                        //obtenemos los equipos asociadas a la organizacion            
                        $at_eq = new \BackendBundle\Entity\AtletaEquipo();
                        $at_eq->setAtleta($atleta);
                        $at_eq->setEquipo($equipo[$i]);
                        $em->persist($at_eq);
                    } else {
                        array_push($problema, "*** El número Máximo de Atletas de la Nómina Abierta ya fue Registrado en la disciplina " . $valor->getDisciplina()->getNombre());
                    }
                } else {
                    array_push($problema, "*** Inscripción Fuera de Fecha para la disciplina " . $valor->getDisciplina()->getNombre());
                }
                $i++;
            }


            if ($guardo) {

                $em->flush();


                if (empty($problema)) {
                    $this->addFlash('success', 'Atleta registrado satisfactoriamente');
                } else {
                    $this->addFlash('success', 'Atleta registrado parcialmente, ver el error indicado a continuacion:');
                    $this->get('session')->getFlashBag()->add('error', $problema);
                }
                return $this->redirectToRoute('atletas_show', array(
                            'id' => $atleta->getId(),
                ));
            } else {
                return $this->render('atletas/new.html.twig', array(
                            'atleta' => $atleta,
                            'form' => $form->createView(),
                            'disciplinas' => $idsD,
                            'jsonEq' => json_encode($idsD),
                            'org' => $_ORG,
                            'organizacion' => $organizacion,
                ));
            }
        }
        return $this->render('atletas/new.html.twig', array(
                    'atleta' => $atleta,
                    'form' => $form->createView(),
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

        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            
        } elseif ($this->get('security.context')->isGranted('ROLE_LIGA')) {
            
        } elseif ($this->get('security.context')->isGranted('ROLE_ORGANIZACION')) {
            //Verifica que solo la universidad que registro el atleta lo pueda ver
            if (!($atleta->getOrganizacion()->getId() == $this->getUser()->getOrganizacion())) {
                throw $this->createAccessDeniedException("You don't have access to this page!");
            }
        } else {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }
        $deleteForm = $this->createDeleteForm($atleta);
        $organizacion = '';
        $em = $this->getDoctrine()->getManager();
        $problema = array();

        //Fijamos La Organización por el usuario logueado, especificamente para el caso de las orgazizaciones  no aplica a administradores ni ligas
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
                    'problemas' => $problema,
        ));
    }

    /**
     * Displays a form to edit an existing Atletas entity.
     *
     * @Route("/{id}/edit", name="atletas_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Atletas $atleta) {

        $constOriginal = $atleta->getContancia();

        if (is_file($this->getParameter('atletas_constancia_directory') . '/' . $constOriginal)):
            $atleta->setContancia(
                    new File($this->getParameter('atletas_constancia_directory') . '/' . $atleta->getContancia())
            );
        endif;



        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            
        } elseif ($this->get('security.context')->isGranted('ROLE_LIGA')) {
            
        } elseif ($this->get('security.context')->isGranted('ROLE_ORGANIZACION')) {
            //Verifica que solo la universidad que registro el atleta lo pueda ver
            if (!($atleta->getOrganizacion()->getId() == $this->getUser()->getOrganizacion())) {
                throw $this->createAccessDeniedException("You don't have access to this page!");
            }
        } else {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }

        //dump($request);  dump($atleta);        die();
        $deleteForm = $this->createDeleteForm($atleta);

        $editForm = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        //Buscamos todos los equipos registrados al atleta
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
        $problema = array();

        //var_dump(empty($_ORG)); die();

        if (!empty($_ORG)):
            $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findBy(array("organizacion" => $_ORG), array('disciplina' => 'DESC'));

        else:
            $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findAll();

        endif;

        if (count($disciplinasOrg) > 0):
            // $idsD = array();
            //$idsDb = array();

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

            //*****Actualizar datos de Atletas
            $atleta->setActualizacion(new \DateTime("now"));
            $atletaDisciplinaRegistrado = 0;

            //*****Guardar Constacia
            $files = $request->files;

            $uploadedFile = $files->get('atletas')['contancia'];
            if (count($uploadedFile) == 0) {

                if ($request->request->get('constOld') !== null && $request->request->get('constOld') == '0') :
                    if (is_file($this->getParameter('atletas_constancia_directory') . '/' . $constOriginal)):
                        unlink($this->getParameter('atletas_constancia_directory') . '/' . $constOriginal);
                    endif;

                    $atleta->setContancia('');
                else:
                    $atleta->setContancia($constOriginal);
                endif;
            } else {
                $file = $atleta->getContancia();
                $fileName = $this->get('app.file_uploader_constancia')->upload($file);
                $atleta->setContancia($fileName);

                if (!empty($constOriginal)) {
                    if (is_file($this->getParameter('atletas_constancia_directory') . '/' . $constOriginal)):
                        unlink($this->getParameter('atletas_constancia_directory') . '/' . $constOriginal);
                    endif;
                }
            }



            $em->persist($atleta);
            $em->flush();


            //*****Actualizar equipos
            //obtenemos los equipos marcados en el editar que desea registrar
            $eqAsociados = $request->request->get('equipos');

            //almacena todos los id de los equipos asociados en la entidad AtletaEquipo
            $rEAEx = array();

            foreach ($aEq as $ae) {
                array_push($rEAEx, $ae->getEquipo()->getId());
            }


//            dump($eqAsociados); //equipo q asociados a la universidad
//            dump($rEAEx); //equipo q tengo registrado
//            die();

            foreach ($eqAsociados as $eq) {

                if (!in_array($eq, $rEAEx)):
                    //Busco el equipo
                    $disciplina = $em->getRepository('BackendBundle:Equipos')->find($eq);

                    //Buscamos los valores de la fecha de inicio y de fin, asi como el valor de la nomina abierta de las  disciplinas donde desea participar
                    $valor = $em->getRepository('BackendBundle:CampeonatoDisciplina')->findOneBy(array('disciplina' => $disciplina->getEquipoOrganizacionCampeonatoDisciplina()->getDisciplina()->getId()));

                    //Verificamos si estamos dentro del rango de fecha permitido para la inscripcion
                    $inicio = $valor->getInicio();
                    $fin = $valor->getFin();
                    $hoy = new \DateTime('now');

                    //Si esta dentro del rango
                    if (($hoy >= $inicio) && ($hoy <= $fin)) {
                        //Verificamos sino estamos por encima del máx de atletas de la Nomina Abierta
                        $nominaAbierta = $valor->getAbierto();

                        //Buscamos la cantidad de atletas registrados
                        $registrados = $em->getRepository('BackendBundle:AtletaEquipo')->findByEquipo(array('equipo' => $disciplina->getId()));

                        $cantidadAtletas = count($registrados);
//                        foreach ($registrados as $reg) {
//                            if ($this->getUser()->getOrganizacion() == $reg->getEquipo()->getEquipoOrganizacionCampeonatoDisciplina()->getOrganizacion()->getId()) {
//                                $cantidadAtletas++;
//                            }
//                        }

                        if ($cantidadAtletas < $nominaAbierta) {
                            $at_eq = new \BackendBundle\Entity\AtletaEquipo();
                            $at_eq->setAtleta($atleta);
                            $at_eq->setEquipo($disciplina);
                            $em->persist($at_eq);
                            $em->flush();
                            $atletaDisciplinaRegistrado++;
                        } else {
                            array_push($problema, "*** El número Máximo de Atletas en la Nómina Abierta ya fue Registrado en la disciplina: " . $valor->getDisciplina()->getNombre());
                        }
                    } else {
                        array_push($problema, "*** Inscripción Fuera de Fecha para la disciplina: " . $valor->getDisciplina()->getNombre());
                    }
                else:
                    //Buscamos si el equipo lo tengo asociado en AtletaEquipo
                    $clave = array_search($eq, $rEAEx);  // $clave = 1;
                    //Determina si el equipo queda asociado al atleta, y contamos como una disciplina asociada al atleta
                    if ($clave !== false):
                        $atletaDisciplinaRegistrado++;
                        array_splice($rEAEx, $clave, 1);
                    endif;

                endif;
            }

            if ($atletaDisciplinaRegistrado === 0):
                array_push($problema, "¡Las diciplinas no fueron actualizadas, verificar errores!");
            else:
                foreach ($aEq as $ae) {
                    if (in_array($ae->getEquipo()->getId(), $rEAEx)):
                        $em->remove($ae);
                        $em->flush();
                    endif;
                }
            endif;




            if (empty($problema)) {
                $this->addFlash('success', 'Atleta registrado satisfactoriamente');
            } else {
                $this->addFlash('success', 'Atleta registrado parcialmente, ver el error indicado a continuacion:');
                $this->get('session')->getFlashBag()->add('error', $problema);
            }
//            dump($problema); die();

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
                    'org' => $_ORG,
                    'urlConstOld' => $constOriginal,
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
