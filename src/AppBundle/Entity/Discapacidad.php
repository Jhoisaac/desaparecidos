<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 23/01/17
 * Time: 12:00
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiscapacidadRepository")
 * @ORM\Table(name="discapacidad")
 * @UniqueEntity(fields={"nombre"}, message="Esta dispacidad ya existe! /nIngresa una nueva!")
 */
class Discapacidad
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $nombre;

    /*/**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
   // private $fecha_ingreso;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estadoDiscapacidad;

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

    /*/**
     * @return \DateTime
     */
    /*public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }*/

    /**
     * @return mixed
     */
    public function getEstadoDiscapacidad()
    {
        return $this->estadoDiscapacidad;
    }

    /**
     * @param mixed $estadoDiscapacidad
     */
    public function setEstadoDiscapacidad($estadoDiscapacidad)
    {
        $this->estadoDiscapacidad = $estadoDiscapacidad;
    }

    public function __construct()
    {
        $this->estadoDiscapacidad = 1;
    }

}