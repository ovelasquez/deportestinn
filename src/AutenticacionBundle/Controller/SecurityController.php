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
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        $csrfToken = $this->has('form.csrf_provider')
            ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ));
    }
    
    
    public function listarUsuariosAction(){
      $em = $this->getDoctrine()->getManager();
      $usuarios = $em->getRepository('BackendBundle:User')->findAll();
      
//      $gruposUsuarios = $this->getUser()->getGroups();
//      
//        
//        foreach ($gruposUsuarios as $grupoUsuario){
//          $nombreGrupoUsuario = $grupoUsuario->getName();
//          if($nombreGrupoUsuario === "Administrador"){
//            $usuarios = $em->getRepository('BackendBundle:User')->findByUsuariosOrdenadosPorId();
//            break;
//          }
//          else{
//            $usuarios = $em->getRepository('BackendBundle:User')->findUsuariosByGrupos();
//          }
//        }
      
      //$usuarios = $em->getRepository('UBVEstacionamientoBundle:Usuarios')->findUsuariosByGrupos();
      //$usuarios = $this->get('fos_user.user_manager')->findUsers();
      
      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate($usuarios, $this->get('request')->query->get('page', 1),10 );
      
        //die(var_dump($pagination));
    return $this->render('BackendnBundle:User:index.html.twig', array('pagination' => $pagination));
      //die(var_dump($usuarios));
    }
    
    
    public function mostrarUsuarioAction($id)
    {
        //$user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackendBundle:User')->findById($id);

        foreach ( $usuario as $atributos){
          $nombreusuario = $atributos->getUsername();
          
        }        
        
        $user = $this->get('fos_user.user_manager')->findUserByUserName($nombreusuario);
        
        //die(var_dump($user));
        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
    }
    
    public function cambioClaveUsuarioAction($id, Request $request)
    {
        //die(var_dump($id));
        
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('BackendBundle:User')->findById($id);
        
        foreach ( $usuario as $atributos){
          $nombreusuario = $atributos->getUsername();
          
        }
        
        $user = $this->get('fos_user.user_manager')->findUserByUserName($nombreusuario);
        
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

        
        //$formFactory = $this->get('fos_user.profile.form.factory');

        //$form = $formFactory->createForm();
        //$form->setData($user);
        $form = $this->createForm(new \UBV\AutenticacionBundle\Form\Type\CambioClaveUsuariosFormType(), $user);
        if ('POST' === $request->getMethod())
        {
          $form->handleRequest($request);
          
          if ($form->isValid()) {
            $gruposRequest = $form["groups"]->getData();
        
            foreach ($gruposRequest as $grupo){
              $nombreGrupo = $grupo->getName();
              //die(var_dump($administrador." ".$nombreGrupo));
              if($nombreGrupo === "Administrador" and $administrador == false){
                throw new AccessDeniedException('Usted No tiene permisos para asignar el grupo administrador');
              }
            }
            
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updateUser($user);
            return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user
        ));
            
          }
          
        }

        return $this->render('FOSUserBundle:ChangePassword:editClaveUsuario.html.twig', array(
            'form' => $form->createView(),
            'id' => $user->getId()
        ));
    }
    
    public function desactivarUsuarioAction(Request $request, $id, $accion)
    {
      $em = $this->getDoctrine()->getManager();
      $usuario = $em->getRepository('BackendBundle:User')->findById($id);

      foreach ( $usuario as $atributos){
        $nombreusuario = $atributos->getUsername();
          
      }        
        
      $user = $this->get('fos_user.user_manager')->findUserByUserName($nombreusuario);
        
      $userManager = $this->container->get('fos_user.user_manager');
      
      if($accion === "desactivar"){
        $user->setEnabled(false);
      }
      else{
        $user->setEnabled(true);
      }
      
      $userManager->UpdateUser($user);
            
      $usuarios = $this->get('fos_user.user_manager')->findUsers();
      
      $paginator = $this->get('knp_paginator');
      $pagination = $paginator->paginate(
      $usuarios, $this->get('request')->query->get('page', 1),10);
      
      $url = $this->generateUrl('autenticacion_usuarios', array('pagination' => $pagination));
      
      return new RedirectResponse($url);
    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
        return $this->render('AutenticacionBundle:Security:login.html.twig', $data);
    }

    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}