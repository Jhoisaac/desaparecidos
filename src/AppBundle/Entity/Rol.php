<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 23/01/17
 * Time: 7:48
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolRepository")
 * @ORM\Table(name="rol")
 * @UniqueEntity(fields={"nombre"}, message="Este rol ya existe! \nIngresa uno nuevo")
 */
class Rol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private  $id;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $nombre;

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

    public function __toString()
    {
        return $this->getNombre();
    }

}