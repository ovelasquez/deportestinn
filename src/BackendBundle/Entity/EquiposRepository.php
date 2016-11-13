<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

use BackendBundle\Entity\Equipos;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EquiposRepository
 *
 * @author Mariana
 */
class EquiposRepository extends EntityRepository {

    //put your code here

    public function findAllByDisciplina($disc) {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT  eq  FROM BackendBundle:Equipos eq  LEFT JOIN BackendBundle:OrganizacionCampeonatoDisciplina r WITH eq.equipoOrganizacionCampeonatoDisciplina=r.id "
                        . "LEFT JOIN BackendBundle:Disciplinas d WITH r.disciplina=d.id WHERE eq.equipoOrganizacionCampeonatoDisciplina IN(:disc)  ORDER BY eq.equipoOrganizacionCampeonatoDisciplina ASC");
        $query->setParameter('disc', $disc);        
        $entities = $query->getResult();

        return $entities;
    }
    
    

}
