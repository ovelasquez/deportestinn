<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendarios
 *
 * @ORM\Table(name="calendarios", indexes={@ORM\Index(name="idx_ff2f19ab485d1881", columns={"campeonato_disciplina_id"})})
 * @ORM\Entity
 */
class Calendarios
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
     * @var integer
     *
     * @ORM\Column(name="numero_equipos", type="integer", nullable=false)
     */
    private $numeroEquipos;

    /**
     * @var string
     *
     * @ORM\Column(name="sistema_juego", type="string", length=255, nullable=false)
     */
    private $sistemaJuego;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_fases", type="integer", nullable=false)
     */
    private $totalFases;

    /**
     * @var \CampeonatoDisciplina
     *
     * @ORM\ManyToOne(targetEntity="CampeonatoDisciplina")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campeonato_disciplina_id", referencedColumnName="id")
     * })
     */
    private $campeonatoDisciplina;



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
     * Set numeroEquipos
     *
     * @param integer $numeroEquipos
     *
     * @return Calendarios
     */
    public function setNumeroEquipos($numeroEquipos)
    {
        $this->numeroEquipos = $numeroEquipos;

        return $this;
    }

    /**
     * Get numeroEquipos
     *
     * @return integer
     */
    public function getNumeroEquipos()
    {
        return $this->numeroEquipos;
    }

    /**
     * Set sistemaJuego
     *
     * @param string $sistemaJuego
     *
     * @return Calendarios
     */
    public function setSistemaJuego($sistemaJuego)
    {
        $this->sistemaJuego = $sistemaJuego;

        return $this;
    }

    /**
     * Get sistemaJuego
     *
     * @return string
     */
    public function getSistemaJuego()
    {
        return $this->sistemaJuego;
    }

    /**
     * Set totalFases
     *
     * @param integer $totalFases
     *
     * @return Calendarios
     */
    public function setTotalFases($totalFases)
    {
        $this->totalFases = $totalFases;

        return $this;
    }

    /**
     * Get totalFases
     *
     * @return integer
     */
    public function getTotalFases()
    {
        return $this->totalFases;
    }

    /**
     * Set campeonatoDisciplina
     *
     * @param \BackendBundle\Entity\CampeonatoDisciplina $campeonatoDisciplina
     *
     * @return Calendarios
     */
    public function setCampeonatoDisciplina(\BackendBundle\Entity\CampeonatoDisciplina $campeonatoDisciplina = null)
    {
        $this->campeonatoDisciplina = $campeonatoDisciplina;

        return $this;
    }

    /**
     * Get campeonatoDisciplina
     *
     * @return \BackendBundle\Entity\CampeonatoDisciplina
     */
    public function getCampeonatoDisciplina()
    {
        return $this->campeonatoDisciplina;
    }
}
