<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use BackendBundle\Entity\AtletaEquipo;


/**
 * Description of AtletaEquipoRepository
 *
 * @author Deportestinn
 */
class AtletaEquipoRepository extends EntityRepository {

    
    public function findAllByDatetimeConsultation($ph,$dat) {
        
        $query = $this->getEntityManager()
                ->createQuery("SELECT  c FROM AppBundle:Calendar c LEFT JOIN c.consultation cs  WHERE (cs.physician=:ph or c.physician=:ph) AND  c.datetimeConsultation >= (:dat)  ORDER BY c.datetimeConsultation ASC");
        $query->setParameter('ph', $ph);
        $query->setParameter('dat', $dat);
        $entities = $query->getResult();

        return $entities;
    }
    
    

}
