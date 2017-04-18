<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 03/01/17
 * Time: 16:11
 */

namespace AppBundle\Entity;

 use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganizacionRepository")
 * @ORM\Table(name="organizacion")
 * @UniqueEntity(fields={"nombre"}, message="Este nombre empresa ya ha sido ingresada")
 * @UniqueEntity(fields={"telefono"}, message="Este telefono ya ha sido utilizado")
 * @UniqueEntity(fields={"email"}, message="Este email ya ha sido utilizado")
 */
class Organizacion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $nombre;
    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tipo_Org")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo_org;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string",nullable=false)
     */
    private $ubicacion;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=10, nullable=false, unique=true)
     */
    private $telefono;
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", length=50, nullable=false, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_ingreso;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean", length=20,nullable=false)
     */
    private $estado;


    /**
     * @ORM\OneToOne(targetEntity="RolxUsuario", mappedBy="organizacion")
     */
    private $rolxusuraio;

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
    public function getTipoOrg()
    {
        return $this->tipo_org;
    }

    /**
     * @param mixed $tipo_org
     */
    public function setTipoOrg(Tipo_Org $tipo_org)
    {
        $this->tipo_org = $tipo_org;
    }

    /**
     * @return mixed
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * @param mixed $ubicacion
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
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
    public function getRolxusuraio()
    {
        return $this->rolxusuraio;
    }

    /**
     * @param mixed $rolxusuraio
     */
    public function setRolxusuraio($rolxusuraio)
    {
        $this->rolxusuraio = $rolxusuraio;
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

    public function __toString()
    {
        return $this->nombre;
    }
}