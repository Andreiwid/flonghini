<?php

namespace AppBundle\Services;


use AppBundle\Entity\FormacaoAcademica;
use AppBundle\Entity\Pesquisador;
use Doctrine\ORM\EntityManagerInterface;

class PesquisadorService
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
     * @param int $id
     * @return Pesquisador|null
     */
    public function getPesquisadorById(int $id): ?Pesquisador
    {
        return $this->entityManager->getRepository('AppBundle:Pesquisador')->findOneBy(['id' => $id]);
    }

    /**
     * @param int $pesquisadorId
     * @return array|null
     */
    public function getArtigosPublicados(int $pesquisadorId): ?array
    {
        return $this->entityManager->getRepository('AppBundle:ArtigosPublicados')
            ->findBy(['pesquisador' => $pesquisadorId]);
    }

    /**
     * @param int $pesquisadorId
     * @return array|null
     */
    public function getArtigosAceitosParaPublicacao(int $pesquisadorId): ?array
    {
        return $this->entityManager->getRepository('AppBundle:ArtigoAceitoParaPublicacao')
            ->findBy(['pesquisador' => $pesquisadorId]);
    }

    /**
     * @param int $pesquisadorId
     * @return array|null
     */
    public function getCapituloOuLivroPublicado(int $pesquisadorId): ?array
    {
        return $this->entityManager->getRepository('AppBundle:CapituloDeLivroPublicado')
            ->findBy(['pesquisador' => $pesquisadorId]);
    }

    /**
     * @param int $id
     * @return array|null
     */
    public function getPesquisadorIdByUserId(int $id): ?array
    {
        return $this->entityManager->getRepository('AppBundle:UsersPesquisadores')->findBy(['user' => $id]);
    }

    /**
     * @param int $pesquisadorId
     * @return array|null
     */
    public function getFormacaoAcademicaByPesquisadorId(int $pesquisadorId): ?array
    {
        return $this->entityManager->getRepository('AppBundle:FormacaoAcademica')
            ->findBy(['pesquisador' => $pesquisadorId]);
    }

    /**
     * @param int $pesquisadorId
     * @return array|null
     */
    public function getTextoEmRevistaOuJornalByPesquisadorId(int $pesquisadorId): ?array
    {
        return $this->entityManager->getRepository('AppBundle:TextoEmJornalOuRevistaPublicado')
            ->findBy(['pesquisador' => $pesquisadorId]);
    }

    /**
     * @param int $pesquisadorId
     * @return array|null
     */
    public function getTrabalhosEmEventos(int $pesquisadorId): ?array
    {
        return $this->entityManager->getRepository('AppBundle:TrabalhosEmEventos')
            ->findBy(['pesquisador' => $pesquisadorId]);
    }
    
}