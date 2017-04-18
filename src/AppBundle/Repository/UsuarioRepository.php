<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UsuarioRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class UsuarioRepository extends EntityRepository
{
    public function findByOneRol()
    {
        return $this->createQueryBuilder('usuario')
            ->andWhere('usuario.rol = :rol')
            ->setParameter('rol', 'Familiar')
            ->getQuery()
            ->execute();
    }
}