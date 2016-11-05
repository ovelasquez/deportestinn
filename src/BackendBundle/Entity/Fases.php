<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fases
 *
 * @ORM\Table(name="fases", indexes={@ORM\Index(name="idx_d4fb8cfba7f6ea19", columns={"calendario_id"})})
 * @ORM\Entity
 */
class Fases
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
     * @ORM\Column(name="numero_grupos", type="integer", nullable=false)
     */
    private $numeroGrupos;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos_ganado", type="integer", nullable=false)
     */
    private $puntosGanado;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos_empatados", type="integer", nullable=false)
     */
    private $puntosEmpatados;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos_perdidos", type="integer", nullable=false)
     */
    private $puntosPerdidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="puntos_forfeit", type="integer", nullable=false)
     */
    private $puntosForfeit;

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
     * Set numeroGrupos
     *
     * @param integer $numeroGrupos
     *
     * @return Fases
     */
    public function setNumeroGrupos($numeroGrupos)
    {
        $this->numeroGrupos = $numeroGrupos;

        return $this;
    }

    /**
     * Get numeroGrupos
     *
     * @return integer
     */
    public function getNumeroGrupos()
    {
        return $this->numeroGrupos;
    }

    /**
     * Set puntosGanado
     *
     * @param integer $puntosGanado
     *
     * @return Fases
     */
    public function setPuntosGanado($puntosGanado)
    {
        $this->puntosGanado = $puntosGanado;

        return $this;
    }

    /**
     * Get puntosGanado
     *
     * @return integer
     */
    public function getPuntosGanado()
    {
        return $this->puntosGanado;
    }

    /**
     * Set puntosEmpatados
     *
     * @param integer $puntosEmpatados
     *
     * @return Fases
     */
    public function setPuntosEmpatados($puntosEmpatados)
    {
        $this->puntosEmpatados = $puntosEmpatados;

        return $this;
    }

    /**
     * Get puntosEmpatados
     *
     * @return integer
     */
    public function getPuntosEmpatados()
    {
        return $this->puntosEmpatados;
    }

    /**
     * Set puntosPerdidos
     *
     * @param integer $puntosPerdidos
     *
     * @return Fases
     */
    public function setPuntosPerdidos($puntosPerdidos)
    {
        $this->puntosPerdidos = $puntosPerdidos;

        return $this;
    }

    /**
     * Get puntosPerdidos
     *
     * @return integer
     */
    public function getPuntosPerdidos()
    {
        return $this->puntosPerdidos;
    }

    /**
     * Set puntosForfeit
     *
     * @param integer $puntosForfeit
     *
     * @return Fases
     */
    public function setPuntosForfeit($puntosForfeit)
    {
        $this->puntosForfeit = $puntosForfeit;

        return $this;
    }

    /**
     * Get puntosForfeit
     *
     * @return integer
     */
    public function getPuntosForfeit()
    {
        return $this->puntosForfeit;
    }

    /**
     * Set totalClasificadosAuto
     *
     * @param integer $totalClasificadosAuto
     *
     * @return Fases
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
     * @return Fases
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
     * Set calendario
     *
     * @param \BackendBundle\Entity\Calendarios $calendario
     *
     * @return Fases
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
