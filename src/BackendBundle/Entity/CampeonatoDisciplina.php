<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CampeonatoDisciplina
 *
 * @ORM\Table(name="campeonato_disciplina", indexes={@ORM\Index(name="idx_5274967e93baae11", columns={"campeonato_id"}), @ORM\Index(name="idx_5274967e2a30b056", columns={"disciplina_id"})})
 * @ORM\Entity
 */
class CampeonatoDisciplina
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
     * @ORM\Column(name="maximo", type="integer", nullable=true)
     */
    private $maximo;

    /**
     * @var integer
     *
     * @ORM\Column(name="minimo", type="integer", nullable=true)
     */
    private $minimo;

  /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date", nullable=false)
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="date", nullable=false)
     */
    private $fin;

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
     * @var \Campeonatos
     *
     * @ORM\ManyToOne(targetEntity="Campeonatos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campeonato_id", referencedColumnName="id")
     * })
     */
    private $campeonato;



    

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
     * Set maximo
     *
     * @param integer $maximo
     *
     * @return CampeonatoDisciplina
     */
    public function setMaximo($maximo)
    {
        $this->maximo = $maximo;

        return $this;
    }

    /**
     * Get maximo
     *
     * @return integer
     */
    public function getMaximo()
    {
        return $this->maximo;
    }

    /**
     * Set minimo
     *
     * @param integer $minimo
     *
     * @return CampeonatoDisciplina
     */
    public function setMinimo($minimo)
    {
        $this->minimo = $minimo;

        return $this;
    }

    /**
     * Get minimo
     *
     * @return integer
     */
    public function getMinimo()
    {
        return $this->minimo;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     *
     * @return CampeonatoDisciplina
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return CampeonatoDisciplina
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set disciplina
     *
     * @param \BackendBundle\Entity\Disciplinas $disciplina
     *
     * @return CampeonatoDisciplina
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
     * Set campeonato
     *
     * @param \BackendBundle\Entity\Campeonatos $campeonato
     *
     * @return CampeonatoDisciplina
     */
    public function setCampeonato(\BackendBundle\Entity\Campeonatos $campeonato = null)
    {
        $this->campeonato = $campeonato;

        return $this;
    }

    /**
     * Get campeonato
     *
     * @return \BackendBundle\Entity\Campeonatos
     */
    public function getCampeonato()
    {
        return $this->campeonato;
    }
}
