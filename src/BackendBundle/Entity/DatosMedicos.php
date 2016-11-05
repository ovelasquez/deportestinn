<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosMedicos
 *
 * @ORM\Table(name="datos__medicos", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_b6600b5287ec6c10", columns={"atleta_id"})})
 * @ORM\Entity
 */
class DatosMedicos
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
     * @ORM\Column(name="altura", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $altura;

    /**
     * @var string
     *
     * @ORM\Column(name="peso", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_sangre", type="string", length=10, nullable=false)
     */
    private $tipoSangre;

    /**
     * @var string
     *
     * @ORM\Column(name="alergias", type="text", nullable=false)
     */
    private $alergias;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto_nombre", type="string", length=255, nullable=false)
     */
    private $contactoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto_telefono", type="string", length=255, nullable=false)
     */
    private $contactoTelefono;

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
     * Set altura
     *
     * @param string $altura
     *
     * @return DatosMedicos
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return string
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set peso
     *
     * @param string $peso
     *
     * @return DatosMedicos
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return string
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set tipoSangre
     *
     * @param string $tipoSangre
     *
     * @return DatosMedicos
     */
    public function setTipoSangre($tipoSangre)
    {
        $this->tipoSangre = $tipoSangre;

        return $this;
    }

    /**
     * Get tipoSangre
     *
     * @return string
     */
    public function getTipoSangre()
    {
        return $this->tipoSangre;
    }

    /**
     * Set alergias
     *
     * @param string $alergias
     *
     * @return DatosMedicos
     */
    public function setAlergias($alergias)
    {
        $this->alergias = $alergias;

        return $this;
    }

    /**
     * Get alergias
     *
     * @return string
     */
    public function getAlergias()
    {
        return $this->alergias;
    }

    /**
     * Set contactoNombre
     *
     * @param string $contactoNombre
     *
     * @return DatosMedicos
     */
    public function setContactoNombre($contactoNombre)
    {
        $this->contactoNombre = $contactoNombre;

        return $this;
    }

    /**
     * Get contactoNombre
     *
     * @return string
     */
    public function getContactoNombre()
    {
        return $this->contactoNombre;
    }

    /**
     * Set contactoTelefono
     *
     * @param string $contactoTelefono
     *
     * @return DatosMedicos
     */
    public function setContactoTelefono($contactoTelefono)
    {
        $this->contactoTelefono = $contactoTelefono;

        return $this;
    }

    /**
     * Get contactoTelefono
     *
     * @return string
     */
    public function getContactoTelefono()
    {
        return $this->contactoTelefono;
    }

    /**
     * Set atleta
     *
     * @param \BackendBundle\Entity\Atletas $atleta
     *
     * @return DatosMedicos
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
