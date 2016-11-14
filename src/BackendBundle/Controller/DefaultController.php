<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        $user = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        $camp = array();
        $atletas = array();
        $disc = array();
        $numa = 0;

        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            //$atletas = $em->getRepository('BackendBundle:Atletas')->findAll();
        } elseif ($this->get('security.context')->isGranted('ROLE_LIGA')) {
            $liga = $em->getRepository('BackendBundle:Campeonatos')->find($user->getLiga());
            $camp = $em->getRepository('BackendBundle:Campeonatos')->findAll(array("liga" => $liga));
        } elseif ($this->get('security.context')->isGranted('ROLE_ORGANIZACION')) {
            $atletas = $em->getRepository('BackendBundle:Atletas')->findAllByOrganizacion($user->getOrganizacion());
            $disc = $em->getRepository('BackendBundle:Disciplinas')->findAllByOrganizacion($user->getOrganizacion());
        } else {
            throw $this->createAccessDeniedException("You don't have access to this page!");
        }

        $numa = count($atletas);

        //dump($numa); die;
        
        return $this->render('BackendBundle:Default:index.html.twig', array(
                    'camp' => $camp,
                    'atletas' => $atletas,
                    'disc' => $disc,
                    'numa' => $numa,
        ));
    }

}
