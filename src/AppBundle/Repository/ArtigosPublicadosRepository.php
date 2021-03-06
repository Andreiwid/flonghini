<?php

namespace AppBundle\Repository;

/**
 * ArtigosPublicadosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArtigosPublicadosRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAnoArtigosPublicados($pesquisadorId): ?array
    {
        return $this->createQueryBuilder('ap')
            ->select('ap.anoDoArtigo')
            ->where('ap.pesquisador = :pesquisadorId')
            ->setParameter(':pesquisadorId', $pesquisadorId)
            ->getQuery()
            ->getResult();
    }
}
