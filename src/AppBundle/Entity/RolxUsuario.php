<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 23/01/17
 * Time: 7:56
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolxUsuarioRepository")
 * @ORM\Table(name="rol_x_usuario")
 */
class RolxUsuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rol")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rol;

    /**
     * @ORM\OneToOne(targetEntity="Organizacion", inversedBy="rolxusuraio")
     * @ORM\JoinColumn(nullable=true)
     */
    private $organizacion;

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
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol(Rol $rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getOrganizacion()
    {
        return $this->organizacion;
    }

    /**
     * @param mixed $organizacion
     */
    public function setOrganizacion(Organizacion $organizacion)
    {
        $this->organizacion = $organizacion;
    }

    public function __toString()
    {
        return $this->usuario->getNombre() . '';
    }

}