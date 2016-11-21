<?php

namespace AutenticacionBundle\Security\Authentication\Handler;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Doctrine\ORM\EntityManager;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface {

    protected $router;
    protected $security;
    protected $em;

    public function __construct(Router $router, SecurityContext $security, EntityManager $em) {
        $this->router = $router;
        $this->security = $security;
        $this->em = $em;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token) {

        $response = null;

        // retrieve user and session id
        $user = $token->getUser();

        if (!empty($request->request->get('_target_path'))):
            $referer = $request->request->get('_target_path');
        else:
            $referer = '';
        endif;



        if ($this->security->isGranted('ROLE_SUPER_ADMIN')) {
            $response = new RedirectResponse($this->router->generate('backend_default_index'));
        } elseif ($this->security->isGranted('ROLE_LIGA')) {
            $response = new RedirectResponse($this->router->generate('backend_default_index'));
        } elseif ($this->security->isGranted('ROLE_ORGANIZACION')) {
            $response = new RedirectResponse($this->router->generate('backend_default_index'));
        } else {
            $response = new RedirectResponse($this->router->generate('backend_default_index'));
        }


        return $response;
    }

}
