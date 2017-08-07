<?php

namespace AppBundle\Services;


use AppBundle\Entity\Pesquisador;
use Doctrine\ORM\EntityManager;

class PesquisadorService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * UserService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getPesquisadorByUserId(int $id)
    {
        return $this->entityManager->getRepository('AppBundle:UsersPesquisadores')->findBy(['user' => $id]);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getPesquisadorById(int $id): ?array
    {
        return $this->entityManager->getRepository('AppBundle:Pesquisador')->findBy(['id' => $id]);
    }
}