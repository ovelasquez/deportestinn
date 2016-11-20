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
        $datetime2 = "";
        $datetime1 = "";
        $dias=0;
        $contCorregir=0;
        $contAprobado=0;

        if ($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            //$atletas = $em->getRepository('BackendBundle:Atletas')->findAll();
        } elseif ($this->get('security.context')->isGranted('ROLE_LIGA')) {
            $liga = $em->getRepository('BackendBundle:Campeonatos')->find($user->getLiga());
            $camp = $em->getRepository('BackendBundle:Campeonatos')->findAll(array("liga" => $liga));
        } elseif ($this->get('security.context')->isGranted('ROLE_ORGANIZACION')) {            
            $atletas = $em->getRepository('BackendBundle:Atletas')->findByOrganizacion($user->getOrganizacion());
            //Contammos cuantos atletas estan por corregir y aprobados
            foreach ($atletas as &$valor) {
               if ($valor->getStatus()==="Por Corregir") { 
                   $contCorregir++;
                   
               } elseif ($valor->getStatus()==="Aprobado") {
                   $contAprobado++;
               }
            }                        
            //echo ("total: ".count($atletas)." Aprobados: ".$contAprobado." Corregir: ".$contCorregir); die;
            $disc = $em->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findAllDisciplinasByCampeonatoDisciplina($user->getOrganizacion());
//            dump($disc);
//            $ocd=array();
//            foreach ($disc as &$valor) {
//              array_push($ocd,$valor);
//            }  
//                        dump($ocd); die();

            $camp = $em->getRepository('BackendBundle:Campeonatos')->find($this->getUser()->getCampeonato());
            
            //Tiempo restante del periodo de inscripcion 
            $datetime2 = ($camp->getFin());
            $datetime1 = ($camp->getInicio());
            $interval = $datetime1->diff($datetime2);
            $totalDias= $interval->format('%R%a');
            
            $datetime22 = (new \DateTime("now"));
            $datetime11 = ($camp->getInicio());
            $interval = $datetime11->diff($datetime22);
            $totalConsumidos= $interval->format('%R%a');            
            
            if ($totalConsumidos>0) $dias= $totalConsumidos*100/$totalDias;            
            if ($dias>100) $dias=100;                                  
        } else {
            throw $this->createAccessDeniedException(":( No tienes acceso para ingresar a esta área!");
        }

        return $this->render('BackendBundle:Default:index.html.twig', array(
                    'camp' => $camp,
                    'atletas' => $atletas,
                    'disc' => $disc,
                    'numa' => count($atletas),
                    'dias' => $dias,
                    'inicio' => $datetime1,
                    'fin' => $datetime2,
                    'contCorregir'=>$contCorregir,
                    'contAprobado'=>$contAprobado,
                    
        ));
    }

}
