<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AtletaEquipo
 *
 * @ORM\Table(name="atleta_equipo", indexes={@ORM\Index(name="equipo_id", columns={"equipo_id"}), @ORM\Index(name="atleta_id", columns={"atleta_id"})})
 * @ORM\Entity
 */
class AtletaEquipo
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
     * @var \Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_id", referencedColumnName="id")
     * })
     */
    private $equipo;

    /**
     * @var \Atletas
     *
     * @ORM\ManyToOne(targetEntity="Atletas", cascade={"persist"})
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
     * Set equipo
     *
     * @param \BackendBundle\Entity\Equipos $equipo
     *
     * @return AtetlaEquipo
     */
    public function setEquipo(\BackendBundle\Entity\Equipos $equipo = null)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo
     *
     * @return \BackendBundle\Entity\Equipos
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set atleta
     *
     * @param \BackendBundle\Entity\Atletas $atleta
     *
     * @return AtetlaEquipo
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
