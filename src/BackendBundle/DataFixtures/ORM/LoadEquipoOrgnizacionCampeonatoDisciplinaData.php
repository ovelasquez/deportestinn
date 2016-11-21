<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Equipos;


class LoadEquipoOrgnizacionCampeonatoDisciplinaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $OrgCampDisciplinas = $manager->getRepository('BackendBundle:OrganizacionCampeonatoDisciplina')->findAll();              
        foreach ($OrgCampDisciplinas as $OrgCampDisciplina) {
           $deportesTinn = new Equipos();
           $deportesTinn->setNombre("Equipo A");
           $deportesTinn->setEquipoOrganizacionCampeonatoDisciplina($OrgCampDisciplina);                
           $manager->persist($deportesTinn);
           $manager->flush();      
        }
      }
    

    public function getOrder()
    {
          return 7;
    }
}