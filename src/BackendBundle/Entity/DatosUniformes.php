<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosUniformes
 *
 * @ORM\Table(name="datos__uniformes", uniqueConstraints={@ORM\UniqueConstraint(name="uniq_24c83eb687ec6c10", columns={"atleta_id"})})
 * @ORM\Entity
 */
class DatosUniformes
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
     * @ORM\Column(name="talla_franela", type="string", length=10, nullable=false)
     */
    private $tallaFranela;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_pantalon", type="string", length=10, nullable=false)
     */
    private $tallaPantalon;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_pantalon_corto", type="string", length=10, nullable=false)
     */
    private $tallaPantalonCorto;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_zapato", type="string", length=10, nullable=false)
     */
    private $tallaZapato;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_gorra", type="string", length=10, nullable=false)
     */
    private $tallaGorra;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_chaqueta", type="string", length=10, nullable=false)
     */
    private $tallaChaqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="talla_medias", type="string", length=10, nullable=false)
     */
    private $tallaMedias;

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
     * Set tallaFranela
     *
     * @param string $tallaFranela
     *
     * @return DatosUniformes
     */
    public function setTallaFranela($tallaFranela)
    {
        $this->tallaFranela = $tallaFranela;

        return $this;
    }

    /**
     * Get tallaFranela
     *
     * @return string
     */
    public function getTallaFranela()
    {
        return $this->tallaFranela;
    }

    /**
     * Set tallaPantalon
     *
     * @param string $tallaPantalon
     *
     * @return DatosUniformes
     */
    public function setTallaPantalon($tallaPantalon)
    {
        $this->tallaPantalon = $tallaPantalon;

        return $this;
    }

    /**
     * Get tallaPantalon
     *
     * @return string
     */
    public function getTallaPantalon()
    {
        return $this->tallaPantalon;
    }

    /**
     * Set tallaPantalonCorto
     *
     * @param string $tallaPantalonCorto
     *
     * @return DatosUniformes
     */
    public function setTallaPantalonCorto($tallaPantalonCorto)
    {
        $this->tallaPantalonCorto = $tallaPantalonCorto;

        return $this;
    }

    /**
     * Get tallaPantalonCorto
     *
     * @return string
     */
    public function getTallaPantalonCorto()
    {
        return $this->tallaPantalonCorto;
    }

    /**
     * Set tallaZapato
     *
     * @param string $tallaZapato
     *
     * @return DatosUniformes
     */
    public function setTallaZapato($tallaZapato)
    {
        $this->tallaZapato = $tallaZapato;

        return $this;
    }

    /**
     * Get tallaZapato
     *
     * @return string
     */
    public function getTallaZapato()
    {
        return $this->tallaZapato;
    }

    /**
     * Set tallaGorra
     *
     * @param string $tallaGorra
     *
     * @return DatosUniformes
     */
    public function setTallaGorra($tallaGorra)
    {
        $this->tallaGorra = $tallaGorra;

        return $this;
    }

    /**
     * Get tallaGorra
     *
     * @return string
     */
    public function getTallaGorra()
    {
        return $this->tallaGorra;
    }

    /**
     * Set tallaChaqueta
     *
     * @param string $tallaChaqueta
     *
     * @return DatosUniformes
     */
    public function setTallaChaqueta($tallaChaqueta)
    {
        $this->tallaChaqueta = $tallaChaqueta;

        return $this;
    }

    /**
     * Get tallaChaqueta
     *
     * @return string
     */
    public function getTallaChaqueta()
    {
        return $this->tallaChaqueta;
    }

    /**
     * Set tallaMedias
     *
     * @param string $tallaMedias
     *
     * @return DatosUniformes
     */
    public function setTallaMedias($tallaMedias)
    {
        $this->tallaMedias = $tallaMedias;

        return $this;
    }

    /**
     * Get tallaMedias
     *
     * @return string
     */
    public function getTallaMedias()
    {
        return $this->tallaMedias;
    }

    /**
     * Set atleta
     *
     * @param \BackendBundle\Entity\Atletas $atleta
     *
     * @return DatosUniformes
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
