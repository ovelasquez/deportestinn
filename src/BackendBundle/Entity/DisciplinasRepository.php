<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

use BackendBundle\Entity\Disciplinas;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DisciplinasRepository
 *
 * @author Mariana
 */
class DisciplinasRepository extends EntityRepository {

    //put your code here

    public function findAllByOrganizacion($org) {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT d  FROM BackendBundle:Disciplinas d "
                        . " LEFT JOIN BackendBundle:OrganizacionCampeonatoDisciplina ocd WITH d.id=ocd.disciplina"
                        . " WHERE ocd.organizacion=:org  ORDER BY d.nombre ASC");
        $query->setParameter('org', $org);        
        $entities = $query->getResult();
        
        return $entities;
    }
    
    

}
