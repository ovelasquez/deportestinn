<?php

namespace AutenticacionBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="liga", type="integer", nullable=false)
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

    public function __construct() {
        parent::__construct();
        // your own logic
    }

}
