<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 03/01/17
 * Time: 16:40
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Rasgos_DistRepository")
 * @ORM\Table(name="rasgos_dist")
 * @UniqueEntity(fields={"nombre"}, message="Este rasgo distintivo ya ha sido ingresado! \nIngresa uno diferente!")
 */
class Rasgos_Dist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string",length=50, unique=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $fecha_ingreso;

    /**
     * @ORM\Column(type="boolean")
     */
    private $estadoRasgoDis;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    /**
     * @return mixed
     */
    public function getEstadoRasgoDis()
    {
        return $this->estadoRasgoDis;
    }

    /**
     * @param mixed $estadoRasgoDis
     */
    public function setEstadoRasgoDis($estadoRasgoDis)
    {
        $this->estadoRasgoDis = $estadoRasgoDis;
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}