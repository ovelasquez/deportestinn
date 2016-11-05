<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosLaborales
 *
 * @ORM\Table(name="datos__laborales", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_39d1c7787ec6c10", columns={"atleta_id"})})
 * @ORM\Entity
 */
class DatosLaborales
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion", type="string", length=255, nullable=false)
     */
    private $institucion;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=255, nullable=false)
     */
    private $departamento;

    /**
     * @var string
     *
     * @ORM\Column(name="contancia", type="string", length=255, nullable=false)
     */
    private $contancia;

    /**
     * @var string
     *
     * @ORM\Column(name="carnet", type="string", length=255, nullable=false)
     */
    private $carnet;

    /**
     * @var \Atletas
     *
     * @ORM\ManyToOne(targetEntity="Atletas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="atleta_id", referencedColumnName="id")
     * })
     */
    private $atleta;



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
     * Set institucion
     *
     * @param string $institucion
     *
     * @return DatosLaborales
     */
    public function setInstitucion($institucion)
    {
        $this->institucion = $institucion;

        return $this;
    }

    /**
     * Get institucion
     *
     * @return string
     */
    public function getInstitucion()
    {
        return $this->institucion;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     *
     * @return DatosLaborales
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set contancia
     *
     * @param string $contancia
     *
     * @return DatosLaborales
     */
    public function setContancia($contancia)
    {
        $this->contancia = $contancia;

        return $this;
    }

    /**
     * Get contancia
     *
     * @return string
     */
    public function getContancia()
    {
        return $this->contancia;
    }

    /**
     * Set carnet
     *
     * @param string $carnet
     *
     * @return DatosLaborales
     */
    public function setCarnet($carnet)
    {
        $this->carnet = $carnet;

        return $this;
    }

    /**
     * Get carnet
     *
     * @return string
     */
    public function getCarnet()
    {
        return $this->carnet;
    }

    /**
     * Set atleta
     *
     * @param \BackendBundle\Entity\Atletas $atleta
     *
     * @return DatosLaborales
     */
    public function setAtleta(\BackendBundle\Entity\Atletas $atleta = null)
    {
        $this->atleta = $atleta;

        return $this;
    }

    /**
     * Get atleta
     *
     * @return \BackendBundle\Entity\Atletas
     */
    public function getAtleta()
    {
        return $this->atleta;
    }
}
