<?php
/**
 * Created by PhpStorm.
 * User: jh0n4
 * Date: 25/01/17
 * Time: 23:06
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="rasgos_x_desap")
 */
class RasgosXdesap
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rasgos_Dist")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rasgos_dist;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Desaparecido")
     * @ORM\JoinColumn(nullable=false)
     */
    private $desaparecido;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Partes_Cuerpo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partes_cuerpo;

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
    public function getRasgosDist()
    {
        return $this->rasgos_dist;
    }

    /**
     * @param mixed $rasgos_dist
     */
    public function setRasgosDist( Rasgos_Dist $rasgos_dist)
    {
        $this->rasgos_dist = $rasgos_dist;
    }

    /**
     * @return mixed
     */
    public function getDesaparecido()
    {
        return $this->desaparecido;
    }

    /**
     * @param mixed $desaparecido
     */
    public function setDesaparecido(Desaparecido $desaparecido)
    {
        $this->desaparecido = $desaparecido;
    }

    /**
     * @return mixed
     */
    public function getPartesCuerpo()
    {
        return $this->partes_cuerpo;
    }

    /**
     * @param mixed $partes_cuerpo
     */
    public function setPartesCuerpo(Partes_Cuerpo $partes_cuerpo)
    {
        $this->partes_cuerpo = $partes_cuerpo;
    }

}