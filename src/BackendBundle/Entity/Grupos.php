<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grupos
 *
 * @ORM\Table(name="grupos", indexes={@ORM\Index(name="idx_45842fe6289a506", columns={"fases_id"})})
 * @ORM\Entity
 */
class Grupos
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
     * @var integer
     *
     * @ORM\Column(name="total_clasificados_auto", type="integer", nullable=false)
     */
    private $totalClasificadosAuto;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_clasificados_manual", type="integer", nullable=false)
     */
    private $totalClasificadosManual;

    /**
     * @var \Fases
     *
     * @ORM\ManyToOne(targetEntity="Fases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fases_id", referencedColumnName="id")
     * })
     */
    private $fases;



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
     * @return Grupos
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
     * Set totalClasificadosAuto
     *
     * @param integer $totalClasificadosAuto
     *
     * @return Grupos
     */
    public function setTotalClasificadosAuto($totalClasificadosAuto)
    {
        $this->totalClasificadosAuto = $totalClasificadosAuto;

        return $this;
    }

    /**
     * Get totalClasificadosAuto
     *
     * @return integer
     */
    public function getTotalClasificadosAuto()
    {
        return $this->totalClasificadosAuto;
    }

    /**
     * Set totalClasificadosManual
     *
     * @param integer $totalClasificadosManual
     *
     * @return Grupos
     */
    public function setTotalClasificadosManual($totalClasificadosManual)
    {
        $this->totalClasificadosManual = $totalClasificadosManual;

        return $this;
    }

    /**
     * Get totalClasificadosManual
     *
     * @return integer
     */
    public function getTotalClasificadosManual()
    {
        return $this->totalClasificadosManual;
    }

    /**
     * Set fases
     *
     * @param \BackendBundle\Entity\Fases $fases
     *
     * @return Grupos
     */
    public function setFases(\BackendBundle\Entity\Fases $fases = null)
    {
        $this->fases = $fases;

        return $this;
    }

    /**
     * Get fases
     *
     * @return \BackendBundle\Entity\Fases
     */
    public function getFases()
    {
        return $this->fases;
    }
}
