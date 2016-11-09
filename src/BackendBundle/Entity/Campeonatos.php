<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;  

/**
 * Campeonatos
 *
 * @ORM\Table(name="campeonatos", indexes={@ORM\Index(name="idx_60cdc91dcf098064", columns={"liga_id"})})
 * @ORM\Entity
 */
class Campeonatos
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=false)
     */
    private $ubicacion;
    
     
     /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes = {"image/png", "image/jpeg", "image/jpg", "image/gif" })
     */
    private $logo;

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
     * @var \Ligas
     *
     * @ORM\ManyToOne(targetEntity="Ligas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="liga_id", referencedColumnName="id")
     * })
     */
    private $liga;


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
     * @return Campeonatos
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Campeonatos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return Campeonatos
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     *
     * @return Campeonatos
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
     * @return Campeonatos
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
     * Set liga
     *
     * @param \BackendBundle\Entity\Ligas $liga
     *
     * @return Campeonatos
     */
    public function setLiga(\BackendBundle\Entity\Ligas $liga = null)
    {
        $this->liga = $liga;

        return $this;
    }

    /**
     * Get liga
     *
     * @return \BackendBundle\Entity\Ligas
     */
    public function getLiga()
    {
        return $this->liga;
    }
    
    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Campeonatos
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }
}
