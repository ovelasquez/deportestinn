<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

use BackendBundle\Entity\Atleta;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AtletaRepository
 *
 * @author Mariana
 */
class AtletaRepository extends EntityRepository {

    //put your code here

    public function findAllByOrganizacion($org) {               
        $query = $this->getEntityManager()
                ->createQuery("SELECT ae   FROM BackendBundle:Atletas a "
                        . " INNER JOIN BackendBundle:AtletaEquipo ae WITH a.id=ae.atleta "
                        . " INNER JOIN BackendBundle:Equipos e WITH e.id=ae.equipo"
                        . " INNER JOIN BackendBundle:OrganizacionCampeonatoDisciplina ocd WITH e.equipoOrganizacionCampeonatoDisciplina=ocd.id and ocd.organizacion=:org "
                        
                        . " ORDER BY a.id ASC");
        $query->setParameter('org', $org);        
        $entities = $query->getResult();        
        return $entities;
    }
    
    
    
    public function findAllWithDisciplina() {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT  a, d  FROM BackendBundle:Atletas a "
                        . " LEFT JOIN BackendBundle:AtletaEquipo ae WITH a.id=ae.atleta "
                        . " LEFT JOIN BackendBundle:Equipos e WITH e.id=ae.equipo"
                        . " LEFT JOIN BackendBundle:OrganizacionCampeonatoDisciplina ocd WITH e.equipoOrganizacionCampeonatoDisciplina=ocd.id"
                        . " LEFT JOIN BackendBundle:Disciplinas d WITH ocd.disciplina=d.id"
                        . "  ORDER BY a.primerNombre ASC");
        $entities = $query->getResult();
        
        return $entities;
    }
    
    public function findAllByCampeonato($cam) {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT  a  FROM BackendBundle:Atletas a "
                        . " LEFT JOIN BackendBundle:AtletaEquipo ae WITH a.id=ae.atleta "
                        . " LEFT JOIN BackendBundle:Equipos e WITH e.id=ae.equipo"
                        . " LEFT JOIN BackendBundle:OrganizacionCampeonatoDisciplina ocd WITH e.equipoOrganizacionCampeonatoDisciplina=ocd.id"
                        . " LEFT JOIN BackendBundle:Organizaciones o WITH o.id=ocd.organizacion"
                        . " WHERE o.campeonato=:cam  ORDER BY a.primerNombre ASC");
        $query->setParameter('cam', $cam);        
        $entities = $query->getResult();
        
        return $entities;
    }
    
    
    public function findAllByLiga($lig) {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT  a  FROM BackendBundle:Atletas a "
                        . " LEFT JOIN BackendBundle:AtletaEquipo ae WITH a.id=ae.atleta "
                        . " LEFT JOIN BackendBundle:Equipos e WITH e.id=ae.equipo"
                        . " LEFT JOIN BackendBundle:OrganizacionCampeonatoDisciplina ocd WITH e.equipoOrganizacionCampeonatoDisciplina=ocd.id"
                        . " LEFT JOIN BackendBundle:Organizaciones o WITH o.id=ocd.organizacion"
                        . " LEFT JOIN BackendBundle:Campeonatos c WITH c.id=o.campeonato"
                        . " WHERE c.liga=:lig  ORDER BY a.primerNombre ASC");
        $query->setParameter('lig', $lig);        
        $entities = $query->getResult();
        
        return $entities;
    }

}
