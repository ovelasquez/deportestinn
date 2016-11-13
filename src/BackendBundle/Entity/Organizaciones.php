<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Organizaciones
 *
 * @ORM\Table(name="organizaciones", indexes={@ORM\Index(name="campeonatos_organizaciones_fk", columns={"campeonato_id"})})
 * @ORM\Entity
 */
class Organizaciones
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
     * @ORM\Column(name="abreviatura", type="string", length=255, nullable=false)
     */
    private $abreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=false)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="rif", type="string", length=255, nullable=false)
     */
    private $rif;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", length=65535, nullable=false)
     */
    private $direccion;

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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Organizaciones
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
     * Set abreviatura
     *
     * @param string $abreviatura
     *
     * @return Organizaciones
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Organizaciones
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

    /**
     * Set rif
     *
     * @param string $rif
     *
     * @return Organizaciones
     */
    public function setRif($rif)
    {
        $this->rif = $rif;

        return $this;
    }

    /**
     * Get rif
     *
     * @return string
     */
    public function getRif()
    {
        return $this->rif;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Organizaciones
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Organizaciones
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Organizaciones
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Organizaciones
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set campeonato
     *
     * @param \BackendBundle\Entity\Campeonatos $campeonato
     *
     * @return Organizaciones
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
     *  get Upload Root Image 
     * @return type
     */
    public function getUploadRootDir() {
        $dir = str_replace('\\', '/', __DIR__);   
        return $dir . '/../../../web/' . $this->getUploadDir();          
    }

    /**
     *  get Upload Dir. 
     * @return type
     */
    public function getUploadDir() {
        return 'uploads/logos/organizaciones';
    }

    /**
     *  get Absolute Path Image 
     * @return type
     */
    public function getAbsolutePath() {
        return null === $this->logo ? null : $this->getUploadRootDir() . '/' . $this->logo;
    }

    /**
     *  get Web Path Image 
     * @return type
     */
    public function getWebPath() {
        return null === $this->logo ? null : $this->getUploadDir() . '/' . $this->logo;
    }
    
     public function __toString() {
        return $this->getNombre();
    }
}
