<?php

namespace BackendBundle\Entity;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\CampeonatoDisciplina;


class LoadCampeonatoDisciplinaData extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $disciplinas = $manager->getRepository('BackendBundle:Disciplinas')->findAll();

      foreach ($disciplinas as $disciplina) {
         $deportesTinn = new CampeonatoDisciplina();
         $deportesTinn->setMaximo(50); 
         $deportesTinn->setMinimo(50);
         $deportesTinn->setInicio(new \DateTime('2016-11-21'));
         $deportesTinn->setFin(new \DateTime('2016-12-16'));
         $deportesTinn->setDisciplina($disciplina);
         $deportesTinn->setCampeonato($this->getReference('campeonato'));
         $deportesTinn->setAbierto(50);
         $deportesTinn->setEntrenador(1);
         $deportesTinn->setAsistente(1);
         $deportesTinn->setDelegado(1);
         $deportesTinn->setMedico(1);
         $deportesTinn->setLogistico(1);
         $manager->persist($deportesTinn);
         $manager->flush();      
      }
    }

      public function getOrder()
      {
          return 4;
      }
  

}