<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 03/01/17
 * Time: 17:06
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DesaparecidoRepository")
 * @ORM\Table(name="desaparecido")
 * @Vich\Uploadable
 * @UniqueEntity(fields={"cedula"}, message="Esta cedula ya se encuentra registrada")
 */
class Desaparecido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El nombre no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El apellido no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $apellido;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El Estado Civil no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $estado_civil;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $rutafoto;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\Image(maxSize = "2000k")
     *
     * @var File
     */
    private $foto;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Debe ingresar solamente numeros!")
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $edad;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 10, max = 10, exactMessage="Este campo debe contener una cedula valida!")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Debe ingresar solamente numeros!")
     * @ORM\Column(type="string", length=10, unique=true, nullable=true)
     */
    private $cedula;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El genero de la persona no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=25)
     */
    private $genero;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="decimal", precision=2, nullable=true)
     * @Assert\Range(min="0", max="2", minMessage="La altura debe ser mayor que cero", maxMessage="La altura maxima permitida es de 2")
     */
    private $altura;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $fecha_ingreso;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecha_lost;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estado;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La contextura no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $contextura;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El color de ojos no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $color_ojos;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El color de la piel no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $color_piel;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="El color del cabello no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $color_cabello;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="decimal", precision=2)
     * @Assert\Range(min="0", max="2", minMessage="El tamano del cabello debe ser mayor que cero", maxMessage="La altura maxima permitida es de 2")
     */
    private $largo_cabello;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La contextura del cabello no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $contextura_cabello;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La forma de la cara no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $forma_cara;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La forma de la nariz no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $forma_nariz;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La forma de los ojos no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $forma_ojos;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="La forma de los labios no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $forma_labios;
    /**
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $barba;
    /**
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bigote;
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RolxUsuario")
     */
    private $rolxuser;

    /**
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Discapacidad")
     * @ORM\JoinTable(name="discapacidad_x_desaparecido")
     */
    private $discapacidad;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }

    /**
     * @param mixed $estado_civil
     */
    public function setEstadoCivil($estado_civil)
    {
        $this->estado_civil = $estado_civil;
    }

    /**
     * @return string
     */
    public function getRutafoto()
    {
        return $this->rutafoto;
    }

    /**
     * @param string $rutafoto
     */
    public function setRutafoto($rutafoto)
    {
        $this->rutafoto = $rutafoto;
    }

    /**
     * @return File
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param File $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    /**
     * @return mixed
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * @param mixed $edad
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param mixed $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * @param mixed $genero
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * @return mixed
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * @param mixed $altura
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    /**
     * @return mixed
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    /**
     * @param mixed $fecha_ingreso
     */
    public function setFechaIngreso($fecha_ingreso)
    {
        $this->fecha_ingreso = $fecha_ingreso;
    }

    /**
     * @return mixed
     */
    public function getFechaLost()
    {
        return $this->fecha_lost;
    }

    /**
     * @param mixed $fecha_lost
     */
    public function setFechaLost($fecha_lost)
    {
        $this->fecha_lost = $fecha_lost;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getContextura()
    {
        return $this->contextura;
    }

    /**
     * @param mixed $contextura
     */
    public function setContextura($contextura)
    {
        $this->contextura = $contextura;
    }

    /**
     * @return mixed
     */
    public function getColorOjos()
    {
        return $this->color_ojos;
    }

    /**
     * @param mixed $color_ojos
     */
    public function setColorOjos($color_ojos)
    {
        $this->color_ojos = $color_ojos;
    }

    /**
     * @return mixed
     */
    public function getColorPiel()
    {
        return $this->color_piel;
    }

    /**
     * @param mixed $color_piel
     */
    public function setColorPiel($color_piel)
    {
        $this->color_piel = $color_piel;
    }

    /**
     * @return mixed
     */
    public function getColorCabello()
    {
        return $this->color_cabello;
    }

    /**
     * @param mixed $color_cabello
     */
    public function setColorCabello($color_cabello)
    {
        $this->color_cabello = $color_cabello;
    }

    /**
     * @return mixed
     */
    public function getLargoCabello()
    {
        return $this->largo_cabello;
    }

    /**
     * @param mixed $largo_cabello
     */
    public function setLargoCabello($largo_cabello)
    {
        $this->largo_cabello = $largo_cabello;
    }

    /**
     * @return mixed
     */
    public function getContexturaCabello()
    {
        return $this->contextura_cabello;
    }

    /**
     * @param mixed $contextura_cabello
     */
    public function setContexturaCabello($contextura_cabello)
    {
        $this->contextura_cabello = $contextura_cabello;
    }

    /**
     * @return mixed
     */
    public function getFormaCara()
    {
        return $this->forma_cara;
    }

    /**
     * @param mixed $forma_cara
     */
    public function setFormaCara($forma_cara)
    {
        $this->forma_cara = $forma_cara;
    }

    /**
     * @return mixed
     */
    public function getFormaNariz()
    {
        return $this->forma_nariz;
    }

    /**
     * @param mixed $forma_nariz
     */
    public function setFormaNariz($forma_nariz)
    {
        $this->forma_nariz = $forma_nariz;
    }

    /**
     * @return mixed
     */
    public function getFormaOjos()
    {
        return $this->forma_ojos;
    }

    /**
     * @param mixed $forma_ojos
     */
    public function setFormaOjos($forma_ojos)
    {
        $this->forma_ojos = $forma_ojos;
    }

    /**
     * @return mixed
     */
    public function getFormaLabios()
    {
        return $this->forma_labios;
    }

    /**
     * @param mixed $forma_labios
     */
    public function setFormaLabios($forma_labios)
    {
        $this->forma_labios = $forma_labios;
    }

    /**
     * @return mixed
     */
    public function getBarba()
    {
        return $this->barba;
    }

    /**
     * @param mixed $barba
     */
    public function setBarba($barba)
    {
        $this->barba = $barba;
    }

    /**
     * @return mixed
     */
    public function getBigote()
    {
        return $this->bigote;
    }

    /**
     * @param mixed $bigote
     */
    public function setBigote($bigote)
    {
        $this->bigote = $bigote;
    }

    /**
     * @return mixed
     */
    public function getRolxuser()
    {
        return $this->rolxuser;
    }

    /**
     * @param mixed $rolxuser
     */
    public function setRolxuser(RolxUsuario $rolxuser)
    {
        $this->rolxuser = $rolxuser;
    }

    /**
     * @return mixed
     */
    public function getDiscapacidad()
    {
        return $this->discapacidad;
    }

    /**
     * @param mixed $discapacidad
     */
    public function setDiscapacidad($discapacidad)
    {
        $this->discapacidad = $discapacidad;
    }

    public function __construct()
    {
        $this->discapacidad = new ArrayCollection();
    }


}