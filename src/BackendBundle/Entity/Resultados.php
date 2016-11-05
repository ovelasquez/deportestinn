<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resultados
 *
 * @ORM\Table(name="resultados", indexes={@ORM\Index(name="idx_f04bd9d1f6a1e75", columns={"encuentro_equipo_id"}), @ORM\Index(name="idx_f04bd9d3573ca15", columns={"resultado_disciplina_id"})})
 * @ORM\Entity
 */
class Resultados
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
     * @ORM\Column(name="valor", type="integer", nullable=false)
     */
    private $valor;

    /**
     * @var \EncuentroEquipo
     *
     * @ORM\ManyToOne(targetEntity="EncuentroEquipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_equipo_id", referencedColumnName="id")
     * })
     */
    private $encuentroEquipo;

    /**
     * @var \ResultadosDisciplinas
     *
     * @ORM\ManyToOne(targetEntity="ResultadosDisciplinas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resultado_disciplina_id", referencedColumnName="id")
     * })
     */
    private $resultadoDisciplina;



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
     * Set valor
     *
     * @param integer $valor
     *
     * @return Resultados
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set encuentroEquipo
     *
     * @param \BackendBundle\Entity\EncuentroEquipo $encuentroEquipo
     *
     * @return Resultados
     */
    public function setEncuentroEquipo(\BackendBundle\Entity\EncuentroEquipo $encuentroEquipo = null)
    {
        $this->encuentroEquipo = $encuentroEquipo;

        return $this;
    }

    /**
     * Get encuentroEquipo
     *
     * @return \BackendBundle\Entity\EncuentroEquipo
     */
    public function getEncuentroEquipo()
    {
        return $this->encuentroEquipo;
    }

    /**
     * Set resultadoDisciplina
     *
     * @param \BackendBundle\Entity\ResultadosDisciplinas $resultadoDisciplina
     *
     * @return Resultados
     */
    public function setResultadoDisciplina(\BackendBundle\Entity\ResultadosDisciplinas $resultadoDisciplina = null)
    {
        $this->resultadoDisciplina = $resultadoDisciplina;

        return $this;
    }

    /**
     * Get resultadoDisciplina
     *
     * @return \BackendBundle\Entity\ResultadosDisciplinas
     */
    public function getResultadoDisciplina()
    {
        return $this->resultadoDisciplina;
    }
}
