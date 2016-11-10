<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipos
 *
 * @ORM\Table(name="equipos", indexes={@ORM\Index(name="organizacion_campeonato_disciplina_equipos_fk", columns={"equipo_organizacion_campeonato_disciplina"})})
 * @ORM\Entity(repositoryClass="BackendBundle\Entity\EquiposRepository")
 */
class Equipos
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \OrganizacionCampeonatoDisciplina
     *
     * @ORM\ManyToOne(targetEntity="OrganizacionCampeonatoDisciplina")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_organizacion_campeonato_disciplina", referencedColumnName="id")
     * })
     */
    private $equipoOrganizacionCampeonatoDisciplina;



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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Equipos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set equipoOrganizacionCampeonatoDisciplina
     *
     * @param \BackendBundle\Entity\OrganizacionCampeonatoDisciplina $equipoOrganizacionCampeonatoDisciplina
     *
     * @return Equipos
     */
    public function setEquipoOrganizacionCampeonatoDisciplina(\BackendBundle\Entity\OrganizacionCampeonatoDisciplina $equipoOrganizacionCampeonatoDisciplina = null)
    {
        $this->equipoOrganizacionCampeonatoDisciplina = $equipoOrganizacionCampeonatoDisciplina;

        return $this;
    }

    /**
     * Get equipoOrganizacionCampeonatoDisciplina
     *
     * @return \BackendBundle\Entity\OrganizacionCampeonatoDisciplina
     */
    public function getEquipoOrganizacionCampeonatoDisciplina()
    {
        return $this->equipoOrganizacionCampeonatoDisciplina;
    }
    public function __toString() {
        return $this->getNombre();
    }
}
