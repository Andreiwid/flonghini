<?php

namespace AppBundle\Services;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class UserService
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

}