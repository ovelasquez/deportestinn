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
    public function newAction(Request $request) {
        $atleta = new Atletas();
        $form = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $form->handleRequest($request);
        $problema = "";
        $em = $this->getDoctrine()->getManager();

        $_ORG = $this->container->getParameter('org');

        $disciplinasOrg = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findBy(array("organizacion" => $_ORG));
        if (count($disciplinasOrg) > 0):
            $idsD = array();
            foreach ($disciplinasOrg as $disc) {
                array_push($idsD, $disc->getId());
            }
            $equipos = $em->getRepository('BackendBundle:Equipos')->findAllByDisciplina($idsD);
            
            foreach ($disciplinasOrg as $disc) {
                array_push($idsD, $disc->getId());
            }

        endif;



        //dump(json_encode(R::exportAll($equipos))); dump(json_encode($disciplinasOrg)); die();

        if ($form->isSubmitted() && $form->isValid()) {



            //Obtenemos la Fotografia
            $file = $atleta->getFotografia();
            //$fileName = $this->get('app.foto_uploader')->upload($file);
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_foto_directory'));
            $atleta->setFotografia($fileName);
            //Obtenemos la Imagen Cedula
            $file = $atleta->getImagenCedula();
            //$fileName = $this->get('app.cedula_uploader')->upload($file);
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_cedula_directory'));
            $atleta->setImagenCedula($fileName);
            //Obtenemos la Constancia de Estudio
            $file = $atleta->getContancia();
            //$fileName = $this->get('app.constancia_uploader')->upload($file);
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_constancia_directory'));
            $atleta->setContancia($fileName);
            //Obtenemos la Carnet
            $file = $atleta->getCarnet();
            //$fileName = $this->get('app.carnet_uploader')->upload($file);
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_carnet_directory'));
            $atleta->setCarnet($fileName);

            $em->persist($atleta);
            $em->flush();

            return $this->redirectToRoute('atletas_show', array('id' => $atleta->getId()));
        }





        return $this->render('atletas/new.html.twig', array(
                    'atleta' => $atleta,
                    'form' => $form->createView(),
                    'problema' => $problema,
                    'disciplinasOrg' => $disciplinasOrg,
                    'equipos' => $equipos,
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
    public function editAction(Request $request, Atletas $atleta) {
        $deleteForm = $this->createDeleteForm($atleta);
        $editForm = $this->createForm('BackendBundle\Form\AtletasType', $atleta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            //Obtenemos la Fotografia
            $file = $atleta->getFotografia();
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_foto_directory'));
            $atleta->setFotografia($fileName);

            //Obtenemos la Imagen Cedula
            $file = $atleta->getImagenCedula();
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_cedula_directory'));
            $atleta->setImagenCedula($fileName);

            //Obtenemos la Constancia de Estudio
            $file = $atleta->getContancia();
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_constancia_directory'));
            $atleta->setContancia($fileName);

            //Obtenemos la Carnet
            $file = $atleta->getCarnet();
            $fileName = $this->get('app.file_uploader')->upload($file, $this->container->getParameter('atletas_carnet_directory'));
            $atleta->setCarnet($fileName);


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
