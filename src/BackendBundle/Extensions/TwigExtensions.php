<?php

// Note that the namespace must match with
// your project !

namespace BackendBundle\Extensions;

use Symfony\Bridge\Doctrine\RegistryInterface;

class TwigExtensions extends \Twig_Extension {

    public function getFunctions() {
        // Register the function in twig :
        // In your template you can use it as : {{find(123)}}
        return array(
            new \Twig_SimpleFunction('findLiga', array($this, 'findLiga')),
            new \Twig_SimpleFunction('findOrganizacion', array($this, 'findLiga')),
        );
    }

    protected $doctrine;

    // Retrieve doctrine from the constructor
    public function __construct(RegistryInterface $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function findLiga($id = 0) {
        
        if ($id !== null):
            $em = $this->doctrine->getManager();
            $liga = $em->getRepository('BackendBundle:Ligas')->find($id);
            return $liga;
        endif;
        return false;
    }

    public function findOrganizacion($id) {
        $em = $this->doctrine->getManager();
        $liga = $em->getRepository('BackendBundle:Organizaciones')->find($id);
        return $liga;
    }

    public function getName() {
        return 'Twig myCustomName Extensions';
    }

}
