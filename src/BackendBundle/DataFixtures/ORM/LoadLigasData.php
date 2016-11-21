<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Ligas;

class LoadLigasData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
       $deportesTinn = new Ligas();
       $deportesTinn->setNombre("Fevedeu");
       $deportesTinn->setDescripcion("Federación Venezolana Deportiva de Educación Universitaria");
       $deportesTinn->setUbicacion("Caracas");
       $deportesTinn->setLogo("fevedeu.png");
       $deportesTinn->setInicio(new \DateTime('2016-11-21'));
       $deportesTinn->setFin(new \DateTime('2017-05-21'));
       $manager->persist($deportesTinn);
       $manager->flush();

       $this->addReference('liga', $deportesTinn);
    }

    public function getOrder()
    {
        return 2;
    }

}