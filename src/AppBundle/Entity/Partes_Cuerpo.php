<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 03/01/17
 * Time: 16:53
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Partes_CuerpoRepository")
 * @ORM\Table(name="partes_cuerpo")
 * @UniqueEntity(fields={"nombre"}, message="Esta parte del cuerpo ya ha sido ingresada!")
 */
class Partes_Cuerpo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * A@Assert\NotBlank()
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $nombre;

    /**
     * @Assert\Blank()
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
     * @return mixed
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }
}