<?php

namespace AppBundle\Services;


use Doctrine\ORM\EntityManagerInterface;

class SearchService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllArtigosPublicadosByKeyword(string $keyword)
    {
        return $this->entityManager->getRepository('AppBundle:PalavrasChaveArtigosPublicados')
            ->getAllArtigosPublicadosByKeyword($keyword);
    }

}