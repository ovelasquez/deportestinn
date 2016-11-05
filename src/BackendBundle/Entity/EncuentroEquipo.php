<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncuentroEquipo
 *
 * @ORM\Table(name="encuentro_equipo", indexes={@ORM\Index(name="idx_6d25924123bfbed", columns={"equipo_id"}), @ORM\Index(name="idx_6d259241e304c7c8", columns={"encuentro_id"})})
 * @ORM\Entity
 */
class EncuentroEquipo
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
     * @var \Equipos
     *
     * @ORM\ManyToOne(targetEntity="Equipos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo_id", referencedColumnName="id")
     * })
     */
    private $equipo;

    /**
     * @var \Encuentros
     *
     * @ORM\ManyToOne(targetEntity="Encuentros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="encuentro_id", referencedColumnName="id")
     * })
     */
    private $encuentro;



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
     * @return EncuentroEquipo
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
     * Set encuentro
     *
     * @param \BackendBundle\Entity\Encuentros $encuentro
     *
     * @return EncuentroEquipo
     */
    public function setEncuentro(\BackendBundle\Entity\Encuentros $encuentro = null)
    {
        $this->encuentro = $encuentro;

        return $this;
    }

    /**
     * Get encuentro
     *
     * @return \BackendBundle\Entity\Encuentros
     */
    public function getEncuentro()
    {
        return $this->encuentro;
    }
}
