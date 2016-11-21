<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Atletas
 *
 * @ORM\Table(name="atletas")
 * @ORM\Entity(repositoryClass="BackendBundle\Entity\AtletaRepository")
 * @UniqueEntity(fields="cedula", message="Disculpe, Ya se ha registardo un Atleta con este número de Cédula ")
 */
class Atletas {

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
     * @ORM\Column(name="nacionalidad", type="string", length=10, nullable=false)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", unique=true, length=255, nullable=false)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=255, nullable=false)
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=255, nullable=true)
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_nombre", type="string", length=255, nullable=false)
     */
    private $primerNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundo_nombre", type="string", length=255, nullable=true)
     */
    private $segundoNombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="genero", type="string", length=255, nullable=false)
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="fotografia", type="string", length=255, nullable=false)
     */
    private $fotografia;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen_cedula", type="string", length=255, nullable=false)
     */
    private $imagenCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    //DATOS Organizacion  
   /**
     * @var \Organizaciones
     *
     * @ORM\ManyToOne(targetEntity="Organizaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="organizacion_id", referencedColumnName="id")
     * })
     */
    private $organizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="ingreso", type="string", length=255, nullable=false)
     */
    private $ingreso;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=255, nullable=false)
     */
    private $departamento;

      
    /**
     * @ORM\Column(type="string",nullable=true)
     *
     * @Assert\File(
     *  maxSize="5242880",
 *      mimeTypes = {
 *          "image/png",
 *          "image/jpeg",
 *          "image/jpg",
 *          "image/gif",
 *          "application/pdf",
 *          "application/x-pdf"
 *      })
     */
    private $contancia;


    /**
     * @var string
     *
     * @ORM\Column(name="carnet", type="string", length=255, nullable=true)
     */
    private $carnet;

    // DATOS MEDICOS

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
     * @ORM\Column(name="alergias", type="text", nullable=true)
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

    // DATOS UNIFORMES

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
     * @ORM\Column(name="talla_medias", type="string", length=10, nullable=true)
     */
    private $tallaMedias;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creacion", type="datetime", nullable=false)
     */
    private $creacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actualizacion", type="datetime", nullable=true)
     */
    private $actualizacion;
    
      /**
     * Constructor of the Category class.
     * (Initialize some fields).
     */
    public function __construct()
    {
        $this->creacion = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     *
     * @return Atletas
     */
    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string
     */
    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Atletas
     */
    public function setCedula($cedula) {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula() {
        return $this->cedula;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return Atletas
     */
    public function setPrimerApellido($primerApellido) {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido() {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     *
     * @return Atletas
     */
    public function setSegundoApellido($segundoApellido) {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
     */
    public function getSegundoApellido() {
        return $this->segundoApellido;
    }

    /**
     * Set primerNombre
     *
     * @param string $primerNombre
     *
     * @return Atletas
     */
    public function setPrimerNombre($primerNombre) {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Get primerNombre
     *
     * @return string
     */
    public function getPrimerNombre() {
        return $this->primerNombre;
    }

    /**
     * Set segundoNombre
     *
     * @param string $segundoNombre
     *
     * @return Atletas
     */
    public function setSegundoNombre($segundoNombre) {
        $this->segundoNombre = $segundoNombre;

        return $this;
    }

    /**
     * Get segundoNombre
     *
     * @return string
     */
    public function getSegundoNombre() {
        return $this->segundoNombre;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Atletas
     */
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    /**
     * Set genero
     *
     * @param string $genero
     *
     * @return Atletas
     */
    public function setGenero($genero) {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero() {
        return $this->genero;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Atletas
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Atletas
     */
    public function setTelefono($telefono) {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono() {
        return $this->telefono;
    }

    /**
     * Set fotografia
     *
     * @param string $fotografia
     *
     * @return Atletas
     */
    public function setFotografia($fotografia) {
        $this->fotografia = $fotografia;

        return $this;
    }

    /**
     * Get fotografia
     *
     * @return string
     */
    public function getFotografia() {
        return $this->fotografia;
    }

    /**
     * Set imagenCedula
     *
     * @param string $imagenCedula
     *
     * @return Atletas
     */
    public function setImagenCedula($imagenCedula) {
        $this->imagenCedula = $imagenCedula;

        return $this;
    }

    /**
     * Get imagenCedula
     *
     * @return string
     */
    public function getImagenCedula() {
        return $this->imagenCedula;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Atletas
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }



    /**
     * Set ingreso
     *
     * @param string $ingreso
     *
     * @return Atletas
     */
    public function setIngreso($ingreso) {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso
     *
     * @return string
     */
    public function getIngreso() {
        return $this->ingreso;
    }

    /**
     * Set departamento
     *
     * @param string $departamento
     *
     * @return Atletas
     */
    public function setDepartamento($departamento) {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return string
     */
    public function getDepartamento() {
        return $this->departamento;
    }

    /**
     * Set contancia
     *
     * @param string $contancia
     *
     * @return Atletas
     */
    public function setContancia($contancia) {
        $this->contancia = $contancia;

        return $this;
    }

    /**
     * Get contancia
     *
     * @return string
     */
    public function getContancia() {
        return $this->contancia;
    }
    

    /**
     * Set carnet
     *
     * @param string $carnet
     *
     * @return Atletas
     */
    public function setCarnet($carnet) {
        $this->carnet = $carnet;

        return $this;
    }

    /**
     * Get carnet
     *
     * @return string
     */
    public function getCarnet() {
        return $this->carnet;
    }

    /**
     * Set altura
     *
     * @param string $altura
     *
     * @return Atletas
     */
    public function setAltura($altura) {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return string
     */
    public function getAltura() {
        return $this->altura;
    }

    /**
     * Set peso
     *
     * @param string $peso
     *
     * @return Atletas
     */
    public function setPeso($peso) {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return string
     */
    public function getPeso() {
        return $this->peso;
    }

    /**
     * Set tipoSangre
     *
     * @param string $tipoSangre
     *
     * @return Atletas
     */
    public function setTipoSangre($tipoSangre) {
        $this->tipoSangre = $tipoSangre;

        return $this;
    }

    /**
     * Get tipoSangre
     *
     * @return string
     */
    public function getTipoSangre() {
        return $this->tipoSangre;
    }

    /**
     * Set alergias
     *
     * @param string $alergias
     *
     * @return Atletas
     */
    public function setAlergias($alergias) {
        $this->alergias = $alergias;

        return $this;
    }

    /**
     * Get alergias
     *
     * @return string
     */
    public function getAlergias() {
        return $this->alergias;
    }

    /**
     * Set contactoNombre
     *
     * @param string $contactoNombre
     *
     * @return Atletas
     */
    public function setContactoNombre($contactoNombre) {
        $this->contactoNombre = $contactoNombre;

        return $this;
    }

    /**
     * Get contactoNombre
     *
     * @return string
     */
    public function getContactoNombre() {
        return $this->contactoNombre;
    }

    /**
     * Set contactoTelefono
     *
     * @param string $contactoTelefono
     *
     * @return Atletas
     */
    public function setContactoTelefono($contactoTelefono) {
        $this->contactoTelefono = $contactoTelefono;

        return $this;
    }

    /**
     * Get contactoTelefono
     *
     * @return string
     */
    public function getContactoTelefono() {
        return $this->contactoTelefono;
    }

    /**
     * Set tallaFranela
     *
     * @param string $tallaFranela
     *
     * @return Atletas
     */
    public function setTallaFranela($tallaFranela) {
        $this->tallaFranela = $tallaFranela;

        return $this;
    }

    /**
     * Get tallaFranela
     *
     * @return string
     */
    public function getTallaFranela() {
        return $this->tallaFranela;
    }

    /**
     * Set tallaPantalon
     *
     * @param string $tallaPantalon
     *
     * @return Atletas
     */
    public function setTallaPantalon($tallaPantalon) {
        $this->tallaPantalon = $tallaPantalon;

        return $this;
    }

    /**
     * Get tallaPantalon
     *
     * @return string
     */
    public function getTallaPantalon() {
        return $this->tallaPantalon;
    }

    /**
     * Set tallaPantalonCorto
     *
     * @param string $tallaPantalonCorto
     *
     * @return Atletas
     */
    public function setTallaPantalonCorto($tallaPantalonCorto) {
        $this->tallaPantalonCorto = $tallaPantalonCorto;

        return $this;
    }

    /**
     * Get tallaPantalonCorto
     *
     * @return string
     */
    public function getTallaPantalonCorto() {
        return $this->tallaPantalonCorto;
    }

    /**
     * Set tallaZapato
     *
     * @param string $tallaZapato
     *
     * @return Atletas
     */
    public function setTallaZapato($tallaZapato) {
        $this->tallaZapato = $tallaZapato;

        return $this;
    }

    /**
     * Get tallaZapato
     *
     * @return string
     */
    public function getTallaZapato() {
        return $this->tallaZapato;
    }

    /**
     * Set tallaGorra
     *
     * @param string $tallaGorra
     *
     * @return Atletas
     */
    public function setTallaGorra($tallaGorra) {
        $this->tallaGorra = $tallaGorra;

        return $this;
    }

    /**
     * Get tallaGorra
     *
     * @return string
     */
    public function getTallaGorra() {
        return $this->tallaGorra;
    }

    /**
     * Set tallaChaqueta
     *
     * @param string $tallaChaqueta
     *
     * @return Atletas
     */
    public function setTallaChaqueta($tallaChaqueta) {
        $this->tallaChaqueta = $tallaChaqueta;

        return $this;
    }

    /**
     * Get tallaChaqueta
     *
     * @return string
     */
    public function getTallaChaqueta() {
        return $this->tallaChaqueta;
    }

    /**
     * Set tallaMedias
     *
     * @param string $tallaMedias
     *
     * @return Atletas
     */
    public function setTallaMedias($tallaMedias) {
        $this->tallaMedias = $tallaMedias;

        return $this;
    }

    /**
     * Get tallaMedias
     *
     * @return string
     */
    public function getTallaMedias() {
        return $this->tallaMedias;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Atletas
     */
    public function setObservacion($observacion) {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion() {
        return $this->observacion;
    }

    /**
     *  get Upload Root Image 
     * @return type
     */
    public function getUploadRootDirFotografia() {
        $dir = str_replace('\\', '/', __DIR__);
        return $dir . '/../../../web/' . $this->getUploadDirFotografia();
    }

    /**
     *  get Upload Dir. 
     * @return type
     */
    public function getUploadDirFotografia() {
        return 'uploads/atletas/fotos';
    }

    /**
     *  get Upload Dir. 
     * @return type
     */
    public function getUploadDirCedula() {
        return 'uploads/atletas/cedulas';
    }

    /**
     *  get Upload Root Image 
     * @return type
     */
    public function getUploadRootDirCedula() {
        $dir = str_replace('\\', '/', __DIR__);
        return $dir . '/../../../web/' . $this->getUploadDirCedula();
    }

    /**
     *  get Upload Dir. 
     * @return type
     */
    public function getUploadDirContancia() {
        return 'uploads/atletas/constancias';
    }

    /**
     *  get Upload Root Image 
     * @return type
     */
    public function getUploadRootDirContancia() {
        $dir = str_replace('\\', '/', __DIR__);
        return $dir . '/../../../web/' . $this->getUploadDirContancia();
    }

    /**
     *  get Upload Dir. 
     * @return type
     */
    public function getUploadDirCarnet() {
        return 'uploads/atletas/carnet';
    }

    /**
     *  get Upload Root Image 
     * @return type
     */
    public function getUploadRootDirCarnet() {
        $dir = str_replace('\\', '/', __DIR__);
        return $dir . '/../../../web/' . $this->getUploadDirCarnet();
    }
    
    public function __toString() {
        return $this->getCedula();
    }


    /**
     * Set organizacion
     *
     * @param \BackendBundle\Entity\Organizaciones $organizacion
     *
     * @return Atletas
     */
    public function setOrganizacion(\BackendBundle\Entity\Organizaciones $organizacion = null)
    {
        $this->organizacion = $organizacion;

        return $this;
    }

    /**
     * Get organizacion
     *
     * @return \BackendBundle\Entity\Organizaciones
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Atletas
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;

        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set actualizacion
     *
     * @param \DateTime $actualizacion
     *
     * @return Atletas
     */
    public function setActualizacion($actualizacion)
    {
        $this->actualizacion = $actualizacion;

        return $this;
    }

    /**
     * Get actualizacion
     *
     * @return \DateTime
     */
    public function getActualizacion()
    {
        return $this->actualizacion;
    }
}
