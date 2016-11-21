<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Campeonatos;

class LoadCampeonatosData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $deportesTinn = new Campeonatos();
       $deportesTinn->setNombre("Eliminatorias Juveneu");
       $deportesTinn->setDescripcion("Federación Venezolana Deportiva de Educación Universitaria");
       $deportesTinn->setUbicacion("Barquisimeto, Edo. Lara");
       $deportesTinn->setLogo("juveneu.png");
       $deportesTinn->setInicio(new \DateTime('2016-11-21'));
       $deportesTinn->setFin(new \DateTime('2017-01-21'));
       $deportesTinn->setLiga($this->getReference('liga'));
       
       $manager->persist($deportesTinn);
       $manager->flush();

        $this->addReference('campeonato', $deportesTinn);

       
    }

     public function getOrder()
    {
        return 3;
    }
}