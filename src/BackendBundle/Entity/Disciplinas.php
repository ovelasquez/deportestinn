<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disciplinas
 *
 * @ORM\Table(name="disciplinas")
 * @ORM\Entity(repositoryClass="BackendBundle\Entity\DisciplinasRepository")
 */
class Disciplinas
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
     * @ORM\Column(name="logo", type="string", length=255, nullable=false)
     */
    private $logo;



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
     * @return Disciplinas
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
     * Set logo
     *
     * @param string $logo
     *
     * @return Disciplinas
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
        return 'uploads/logos/disciplinas';
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
