<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 19/01/17
 * Time: 0:57
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 * @ORM\Table(name="usuario")
 * @Vich\Uploadable
 * @UniqueEntity(fields={"email"}, message="Este email ya ha sido utilizado!")
 * @UniqueEntity(fields={"cedula"}, message="Esta cedula ya se encuentra registrada")
 * @UniqueEntity(fields={"telefono"}, message="Este Telefono ya se ha utilizado en otra cuenta")
 * @UniqueEntity(fields={"celular"}, message="Este Celular ya se ha utilizado en otra cuenta")
 */
class Usuario implements UserInterface, \Serializable
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
     *     message="Tu nombre no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Tu apellido no puede contener numeros"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $apellido;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min = 10, max = 10, exactMessage="Este campo debe contener una cedula valida!")
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Debe ingresar solamente numeros!")
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $cedula;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     */
    private $fchNaci;

    /**
     * @Assert\Regex(pattern="/^[0-9]*$/", message="Debe ingresar solamente numeros!")
     * @Assert\Length(min = 9, max = 9, exactMessage="Ingrese un numero de telefono convencional valido!")
     * @ORM\Column(type="string", length=10, unique=true, nullable=true)
     */
    private $telefono;
    /**
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^09[0-9]*$/", message="Debe ingresar solamente numeros con 09 al inicio! ")
     * @Assert\Length(min = 10, max = 10, exactMessage="Ingrese un numero de celular valido!")
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $celular;   /* /^\+31\(0\)[0-9]*$ */

    /**
     *A non-persisted field that's used to add rol
     * @Assert\NotBlank(groups={"Registro"}, message="Este valor no debe estar en blanco")
     * @var Rol
     */
    private $rol;

    /**
     * A non-persisted field that's used to add organizaciones.
     * @var Organizacion
     */
    private $organiz;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $rutafoto;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * @Assert\Image(maxSize = "900k")
     * @Vich\UploadableField(mapping="fotos_usuarios", fileNameProperty="rutafoto")
     *
     * @var File
     */
    private $foto;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @Assert\Email()
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $fecha_ingreso;

    /**
     * The encoded password
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     * @Assert\NotBlank(groups={"Registro"}, message="Este valor no debe estar en blanco")
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    public function __construct()
    {
        $this->fecha_ingreso = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->rutafoto = 'usuario.png';
    }

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
    public function getFchNaci()
    {
        return $this->fchNaci;
    }

    /**
     * @param mixed $fchNaci
     */
    public function setFchNaci($fchNaci)
    {
        $this->fchNaci = $fchNaci;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * @return Rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return Organizacion
     */
    public function getOrganiz()
    {
        return $this->organiz;
    }

    /**
     * @param Organizacion $organiz
     */
    public function setOrganiz($organiz)
    {
        $this->organiz = $organiz;
    }

    /**
     * @return string|null
     */
    public function getRutafoto()
    {
        return $this->rutafoto;
    }

    /**
     * @param string $rutafoto
     *
     * @return Usuario
     */
    public function setRutafoto($rutafoto)
    {
        $this->rutafoto = $rutafoto;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $foto
     *
     * @return $this
     */
    public function setFoto(File $foto = null)
    {
        $this->foto = $foto;

        /*// para que el "listener" de Doctrine guarde bien los cambios, al menos
        // una propiedad debe cambiar su valor (además de la propiedad de la foto)
        if (null !== $foto) {
            $this->updatedAt = new \Datetime('now');
        }

        /*$this->foto = $photo;*/

        if ($foto) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        //guarantess that the entity looks "dirty" to Doctrine
        //when changin the plainPassword
        $this->password = null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        //if($this->getRol()->getId())

        $roles = $this->roles;

        /*if (!in_array('ROLE_Familiar', $roles)){
            $roles[] = 'ROLE_Familiar';
        }*/

        return $roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function __toString()
    {
        return $this->nombre . '';
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function getPath(){
        return "uploads/fotos/".$this->getRutafoto();
    }

}