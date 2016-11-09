<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ligas
 *
 * @ORM\Table(name="ligas")
 * @ORM\Entity
 */
class Ligas {

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
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=true)
     */
    private $ubicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=false)
     */
    private $logo;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Ligas
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Ligas
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return Ligas
     */
    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion() {
        return $this->ubicacion;
    }

    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Ligas
     */
    public function setLogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo() {
        return $this->logo;
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
        return 'uploads/logos/ligas';
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

}
