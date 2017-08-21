<?php

namespace AppBundle\Services;


use AppBundle\Entity\ArtigosPublicados;
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

    /**
     * @param string $keyword
     * @return array|null
     */
    public function getAllArtigosPublicadosByKeyword(string $keyword): ?array
    {
        return $this->entityManager->getRepository('AppBundle:PalavrasChaveArtigosPublicados')
            ->getAllArtigosPublicadosByKeyword($keyword);
    }

    /**
     * @param string $keyword
     * @return array|null
     */
    public function getAllArtigosAceitosParaPublicacaoByKeyword(string $keyword): ?array
    {
        return $this->entityManager->getRepository('AppBundle:PalavrasChaveArtigoAceitoParaPublicacao')
            ->getAllArtigosAceitosParaPublicacao($keyword);
    }

    /**
     * @param string $keyword
     * @return array|null
     */
    public function getAllCapituloOuLivroPublicadoByKeyword(string $keyword): ?array
    {
        return $this->entityManager->getRepository('AppBundle:PalavrasChaveCapituloDeLivroPublicado')
            ->getAllCapituloOuLivroPublicado($keyword);
    }

    /**
     * @param string $keyword
     * @return array|null
     */
    public function getAllTrabalhosEmEventosByKeyword(string $keyword): ?array
    {
        return $this->entityManager->getRepository('AppBundle:PalavrasChaveTrabalhoEmEvento')
            ->getAllTrabalhosEmEventos($keyword);
    }

    /**
     * @param string $keyword
     * @return array|null
     */
    public function getAllTextosEmJornalOuRevistaByKeyword(string $keyword): ?array
    {
        return $this->entityManager->getRepository('AppBundle:PalavrasChaveTextoEmJornalOuRevista')
            ->getAllTextosEmJornalOuRevista($keyword);
    }

}