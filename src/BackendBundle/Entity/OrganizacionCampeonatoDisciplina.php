<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizacionCampeonatoDisciplina
 *
 * @ORM\Table(name="organizacion_campeonato_disciplina", indexes={@ORM\Index(name="organizacion_id", columns={"organizacion_id"}), @ORM\Index(name="disciplinas_organizacion_campeonato_disciplina_fk", columns={"disciplina_id"})})
 * @ORM\Entity(repositoryClass="BackendBundle\Entity\OrganizacionCampeonatoDisciplinaRepository")
 */
class OrganizacionCampeonatoDisciplina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Disciplinas
     *
     * @ORM\ManyToOne(targetEntity="Disciplinas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="disciplina_id", referencedColumnName="id")
     * })
     */
    private $disciplina;

    /**
     * @var \Organizaciones
     *
     * @ORM\ManyToOne(targetEntity="Organizaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organizacion_id", referencedColumnName="id")
     * })
     */
    private $organizacion;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set disciplina
     *
     * @param \BackendBundle\Entity\Disciplinas $disciplina
     *
     * @return OrganizacionCampeonatoDisciplina
     */
    public function setDisciplina(\BackendBundle\Entity\Disciplinas $disciplina = null)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get disciplina
     *
     * @return \BackendBundle\Entity\Disciplinas
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }

    /**
     * Set organizacion
     *
     * @param \BackendBundle\Entity\Organizaciones $organizacion
     *
     * @return OrganizacionCampeonatoDisciplina
     */
    public function setOrganizacion(\BackendBundle\Entity\Organizaciones $organizacion = null)
    {
        $this->organizacion = $organizacion;

        return $this;
    }

    /**
     * Get organizacion
     *
     * @return \BackendBundle\Entity\Organizaciones
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }
    
    public function __toString() {
        return $this->getOrganizacion()->getNombre()." - ".$this->getDisciplina()->getNombre();
    }
}
