<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\OrganizacionCampeonatoDisciplina;


class LoadOrgnizacionCampeonatoDisciplinaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $universidades = $manager->getRepository('BackendBundle:Organizaciones')->findAll();
        $disciplinas = $manager->getRepository('BackendBundle:Disciplinas')->findAll();

      foreach ($universidades as $universidad) {
        foreach ($disciplinas as $disciplina) {
           $deportesTinn = new OrganizacionCampeonatoDisciplina();
           $deportesTinn->setDisciplina($disciplina);
           $deportesTinn->setOrganizacion($universidad);                
           $manager->persist($deportesTinn);
           $manager->flush();      
        }
      }
    }

    public function getOrder()
    {
          return 6;
    }
}