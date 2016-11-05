<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AutenticacionBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends Controller
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
    }

    /**
     * Edit the user
     */
    public function editAction($id,Request $request)
    {
      if(isset($id)){
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('UBVEstacionamientoBundle:Usuarios')->findById($id);

        foreach ( $usuario as $atributos){
          $nombreusuario = $atributos->getUsername();
        }        

        $user = $this->get('fos_user.user_manager')->findUserByUserName($nombreusuario);
      }
      else{
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
          throw new AccessDeniedException('This user does not have access to this section.');
        }
      }
      
      $gruposUsuarios = $this->getUser()->getGroups();
        
        foreach ($gruposUsuarios as $grupoUsuario){
          $nombreGrupoUsuario = $grupoUsuario->getName();
          if($nombreGrupoUsuario === "Administrador"){
            $administrador=true;
            break;
          }
          else{
            $administrador=false;
          }
        }

      /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
      $dispatcher = $this->get('event_dispatcher');

      $event = new GetResponseUserEvent($user, $request);
      $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

      if (null !== $event->getResponse()) {
          return $event->getResponse();
      }

      /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
      $formFactory = $this->get('fos_user.profile.form.factory');

      $form = $formFactory->createForm();
      $form->setData($user);

      $form->handleRequest($request);
      
      if ($form->isValid()) {
        
        //die(var_dump($administrador));
        
        $gruposRequest = $form["groups"]->getData();
        
        foreach ($gruposRequest as $grupo){
          $nombreGrupo = $grupo->getName();
          //die(var_dump($administrador." ".$nombreGrupo));
          if($nombreGrupo === "Administrador" and $administrador == false){
            throw new AccessDeniedException('Usted No tiene permisos para asignar el grupo administrador');
          }
        }
        
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');

        $event = new FormEvent($form, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

        $userManager->updateUser($user);

        if (null === $response = $event->getResponse()) {
          if(isset($id)){
            $url = $this->generateUrl('ubv_autenticacion_mostrar_usuarios',array('id'=>$id));
            $response = new RedirectResponse($url);
          }
          else{
            $url = $this->generateUrl('fos_user_profile_show');
            $response = new RedirectResponse($url);                
          }
        }

        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

        return $response;
      }

    return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
        'form' => $form->createView(),
        'id'=>$id,
    ));
  }
}
