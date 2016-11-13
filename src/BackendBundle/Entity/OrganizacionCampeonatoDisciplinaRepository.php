<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

use BackendBundle\Entity\OrganizacionCampeonatoDisciplina;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrganizacionCampeonatoDisciplinaRepository
 *
 * @author Mariana
 */
class OrganizacionCampeonatoDisciplinaRepository extends EntityRepository {

    //put your code here

    public function findAllWithDisciplinaByOrganizacion($org) {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT  r,d  FROM BackendBundle:OrganizacionCampeonatoDisciplina r "
                        . "LEFT JOIN BackendBundle:Disciplinas d WITH r.disciplina=d.id WHERE r.organizacion=:org  ORDER BY d.nombre ASC");
        $query->setParameter('org', $org);        
        $entities = $query->getResult();
        dump($entities);
        return $entities;
    }
    
    

}
