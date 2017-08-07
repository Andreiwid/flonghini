<?php

namespace AppBundle\Repository;


class UsersPesquisadoresRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPesquisador(int $id)
    {
        return $this->createQueryBuilder('usersPesquisadores')
            ->select('usersPesquisadores')
            ->where('usersPesquisadores.user = :user')
            ->setParameter(':user', $id)
            ->getQuery();
    }
}