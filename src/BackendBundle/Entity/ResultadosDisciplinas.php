<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultadosDisciplinas
 *
 * @ORM\Table(name="resultados_disciplinas", indexes={@ORM\Index(name="idx_27f1f4ff2a30b056", columns={"disciplina_id"})})
 * @ORM\Entity
 */
class ResultadosDisciplinas
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
     * @ORM\Column(name="disciplina_id", type="bigint", nullable=true)
     */
    private $disciplinaId;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_obligatorio", type="boolean", nullable=false)
     */
    private $esObligatorio;



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
     * Set disciplinaId
     *
     * @param integer $disciplinaId
     *
     * @return ResultadosDisciplinas
     */
    public function setDisciplinaId($disciplinaId)
    {
        $this->disciplinaId = $disciplinaId;

        return $this;
    }

    /**
     * Get disciplinaId
     *
     * @return integer
     */
    public function getDisciplinaId()
    {
        return $this->disciplinaId;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ResultadosDisciplinas
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
     * Set esObligatorio
     *
     * @param boolean $esObligatorio
     *
     * @return ResultadosDisciplinas
     */
    public function setEsObligatorio($esObligatorio)
    {
        $this->esObligatorio = $esObligatorio;

        return $this;
    }

    /**
     * Get esObligatorio
     *
     * @return boolean
     */
    public function getEsObligatorio()
    {
        return $this->esObligatorio;
    }
}
