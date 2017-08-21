<?php

namespace AppBundle\Repository;

/**
 * PalavrasChaveArtigosPublicadosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PalavrasChaveArtigosPublicadosRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllArtigosPublicadosByKeyword($keyword)
    {
        return $this->createQueryBuilder('pcap')
            ->select('pcap')
            ->where('pcap.palavraChave1 LIKE :keyword')
            ->orWhere('pcap.palavraChave2 LIKE :keyword')
            ->orWhere('pcap.palavraChave3 LIKE :keyword')
            ->orWhere('pcap.palavraChave4 LIKE :keyword')
            ->orWhere('pcap.palavraChave5 LIKE :keyword')
            ->orWhere('pcap.palavraChave6 LIKE :keyword')
            ->setParameter(':keyword', '%'.$keyword.'%')
            ->getQuery()
            ->getResult();
    }
}
