<?php

namespace AutenticacionBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * 
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="AutenticacionBundle\Entity\Group")
     * @ORM\JoinTable(name="fos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;

    /**
     * @var integer
     *
     * @ORM\Column(name="liga", type="integer", nullable=true)
     */
    private $liga;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="campeonato", type="integer", nullable=true)
     */
    private $campeonato;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="organizacion", type="integer", nullable=true)
     */
    private $organizacion;

    

    /**
     * Set apellido
     *
     * @param string $apellido
     *
     * @return User
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return User
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
     * Set liga
     *
     * @param integer $liga
     *
     * @return User
     */
    public function setLiga($liga)
    {
        $this->liga = $liga;

        return $this;
    }

    /**
     * Get liga
     *
     * @return integer
     */
    public function getLiga()
    {
        return $this->liga;
    }

    /**
     * Set campeonato
     *
     * @param integer $campeonato
     *
     * @return User
     */
    public function setCampeonato($campeonato)
    {
        $this->campeonato = $campeonato;

        return $this;
    }

    /**
     * Get campeonato
     *
     * @return integer
     */
    public function getCampeonato()
    {
        return $this->campeonato;
    }

    /**
     * Set organizacion
     *
     * @param integer $organizacion
     *
     * @return User
     */
    public function setOrganizacion($organizacion)
    {
        $this->organizacion = $organizacion;

        return $this;
    }

    /**
     * Get organizacion
     *
     * @return integer
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }
    
    public function setRoles(array $roles)
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }
    
    public function getRoles()
    {
        return $this->roles;
    }
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function __toString()
    {
        return (string) $this->getName();
    }
}
