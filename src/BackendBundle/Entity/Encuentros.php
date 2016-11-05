<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Encuentros
 *
 * @ORM\Table(name="encuentros", indexes={@ORM\Index(name="idx_46ab2e7e9c833003", columns={"grupo_id"}), @ORM\Index(name="idx_46ab2e7ea7f6ea19", columns={"calendario_id"}), @ORM\Index(name="idx_46ab2e7e9d28fb52", columns={"fase_id"})})
 * @ORM\Entity
 */
class Encuentros
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \Grupos
     *
     * @ORM\ManyToOne(targetEntity="Grupos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     * })
     */
    private $grupo;

    /**
     * @var \Fases
     *
     * @ORM\ManyToOne(targetEntity="Fases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fase_id", referencedColumnName="id")
     * })
     */
    private $fase;

    /**
     * @var \Calendarios
     *
     * @ORM\ManyToOne(targetEntity="Calendarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calendario_id", referencedColumnName="id")
     * })
     */
    private $calendario;



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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Encuentros
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set grupo
     *
     * @param \BackendBundle\Entity\Grupos $grupo
     *
     * @return Encuentros
     */
    public function setGrupo(\BackendBundle\Entity\Grupos $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \BackendBundle\Entity\Grupos
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set fase
     *
     * @param \BackendBundle\Entity\Fases $fase
     *
     * @return Encuentros
     */
    public function setFase(\BackendBundle\Entity\Fases $fase = null)
    {
        $this->fase = $fase;

        return $this;
    }

    /**
     * Get fase
     *
     * @return \BackendBundle\Entity\Fases
     */
    public function getFase()
    {
        return $this->fase;
    }

    /**
     * Set calendario
     *
     * @param \BackendBundle\Entity\Calendarios $calendario
     *
     * @return Encuentros
     */
    public function setCalendario(\BackendBundle\Entity\Calendarios $calendario = null)
    {
        $this->calendario = $calendario;

        return $this;
    }

    /**
     * Get calendario
     *
     * @return \BackendBundle\Entity\Calendarios
     */
    public function getCalendario()
    {
        return $this->calendario;
    }
}
