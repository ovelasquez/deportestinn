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
     * @ORM\Column(name="maximo", type="integer", nullable=false)
     */
    private $maximo;

    /**
     * @var integer
     *
     * @ORM\Column(name="minimo", type="integer", nullable=false)
     */
    private $minimo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="abierto", type="integer", nullable=false)
     */
    private $abierto;
    
      /**
     * @var integer
     *
     * @ORM\Column(name="entrenador", type="integer", nullable=false)
     */
    private $entrenador;
    
       /**
     * @var integer
     *
     * @ORM\Column(name="asistente", type="integer", nullable=false)
     */
    private $asistente;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="delegado", type="integer", nullable=false)
     */
    private $delegado;
    
      /**
     * @var integer
     *
     * @ORM\Column(name="medico", type="integer", nullable=false)
     */
    private $medico;
    
          /**
     * @var integer
     *
     * @ORM\Column(name="logistico", type="integer", nullable=false)
     */
    private $logistico;
    
    
    
    

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

    /**
     * Set abierto
     *
     * @param integer $abierto
     *
     * @return CampeonatoDisciplina
     */
    public function setAbierto($abierto)
    {
        $this->abierto = $abierto;

        return $this;
    }

    /**
     * Get abierto
     *
     * @return integer
     */
    public function getAbierto()
    {
        return $this->abierto;
    }

    /**
     * Set entrenador
     *
     * @param integer $entrenador
     *
     * @return CampeonatoDisciplina
     */
    public function setEntrenador($entrenador)
    {
        $this->entrenador = $entrenador;

        return $this;
    }

    /**
     * Get entrenador
     *
     * @return integer
     */
    public function getEntrenador()
    {
        return $this->entrenador;
    }

    /**
     * Set asistente
     *
     * @param integer $asistente
     *
     * @return CampeonatoDisciplina
     */
    public function setAsistente($asistente)
    {
        $this->asistente = $asistente;

        return $this;
    }

    /**
     * Get asistente
     *
     * @return integer
     */
    public function getAsistente()
    {
        return $this->asistente;
    }

    /**
     * Set delegado
     *
     * @param integer $delegado
     *
     * @return CampeonatoDisciplina
     */
    public function setDelegado($delegado)
    {
        $this->delegado = $delegado;

        return $this;
    }

    /**
     * Get delegado
     *
     * @return integer
     */
    public function getDelegado()
    {
        return $this->delegado;
    }

    /**
     * Set medico
     *
     * @param integer $medico
     *
     * @return CampeonatoDisciplina
     */
    public function setMedico($medico)
    {
        $this->medico = $medico;

        return $this;
    }

    /**
     * Get medico
     *
     * @return integer
     */
    public function getMedico()
    {
        return $this->medico;
    }

    /**
     * Set logistico
     *
     * @param integer $logistico
     *
     * @return CampeonatoDisciplina
     */
    public function setLogistico($logistico)
    {
        $this->logistico = $logistico;

        return $this;
    }

    /**
     * Get logistico
     *
     * @return integer
     */
    public function getLogistico()
    {
        return $this->logistico;
    }
}
