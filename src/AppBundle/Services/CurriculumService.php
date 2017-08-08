<?php

namespace AppBundle\Services;

use AppBundle\Entity\AreasDoConhecimentoArtigo;
use AppBundle\Entity\AreasDoConhecimentoArtigoAceitoParaPublicacao;
use AppBundle\Entity\AreasDoConhecimentoCapituloDeLivro;
use AppBundle\Entity\AreasDoConhecimentoTextoEmJornalOuRevista;
use AppBundle\Entity\AreasDoConhecimentoTrabalhoEmEvento;
use AppBundle\Entity\ArtigoAceitoParaPublicacao;
use AppBundle\Entity\ArtigosPublicados;
use AppBundle\Entity\AutoresArtigoAceitoParaPublicacao;
use AppBundle\Entity\AutoresArtigosPublicados;
use AppBundle\Entity\AutoresCapituloDeLivroPublicado;
use AppBundle\Entity\AutoresTextoEmJornalOuRevista;
use AppBundle\Entity\AutoresTrabalhosEmEventos;
use AppBundle\Entity\CapituloDeLivroPublicado;
use AppBundle\Entity\FormacaoAcademica;
use AppBundle\Entity\Pesquisador;
use AppBundle\Entity\SetoresDeAtividadeArtigoAceitoParaPublicacao;
use AppBundle\Entity\SetoresDeAtividadeArtigosPublicados;
use AppBundle\Entity\SetoresDeAtividadeCapituloDeLivroPublicado;
use AppBundle\Entity\SetoresDeAtividadeTextoEmJornalOuRevista;
use AppBundle\Entity\SetoresDeAtividadeTrabalhoEmEvento;
use AppBundle\Entity\TextoEmJornalOuRevistaPublicado;
use AppBundle\Entity\TrabalhosEmEventos;
use AppBundle\Entity\User;
use AppBundle\Entity\UsersPesquisadores;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class CurriculumService
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var Container
     */
    private $container;

    /**
     * CurriculumService constructor.
     * @param EntityManager $entityManager
     * @param Container $container
     */
    public function __construct(EntityManager $entityManager, Container $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     * @param $curriculo
     * @return Pesquisador
     */
    public function salvarPesquisador(array $curriculo): Pesquisador
    {
        $pesquisador = new Pesquisador();
        $pesquisador->setNomeCompleto($curriculo['DADOS-GERAIS']['@attributes']['NOME-COMPLETO']);
        $pesquisador->setNacionalidade($curriculo['DADOS-GERAIS']['@attributes']['PAIS-DE-NACIONALIDADE']);
        $pesquisador->setNomeEmCitacoes($curriculo['DADOS-GERAIS']['@attributes']['NOME-EM-CITACOES-BIBLIOGRAFICAS']);
        $this->entityManager->persist($pesquisador);
        $this->entityManager->flush();
        $usersPesquisadores = new UsersPesquisadores();
        /**
         * @var User $user
         */
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $usersPesquisadores->setPesquisador($pesquisador);
        $usersPesquisadores->setUser($user);
        $this->entityManager->persist($usersPesquisadores);
        $this->entityManager->flush();

        return $pesquisador;
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarFormacaoAcademicaGraduacao(array $curriculo, Pesquisador $pesquisador): void
    {
        $formacaoAcademicaArrayGraduacao = $curriculo['DADOS-GERAIS']
        ['FORMACAO-ACADEMICA-TITULACAO']['GRADUACAO'];
        if (!is_null($formacaoAcademicaArrayGraduacao)) {
            if (sizeof($formacaoAcademicaArrayGraduacao) > 1) {
                foreach ($formacaoAcademicaArrayGraduacao as $formacao) {
                    $formacaoAcademica = new FormacaoAcademica();
                    $formacaoAcademica->setInstituicao($formacao['@attributes']['NOME-INSTITUICAO']);
                    $formacaoAcademica->setPesquisador($pesquisador);
                    $formacaoAcademica->setCurso($formacao['@attributes']['NOME-CURSO']);
                    $formacaoAcademica->setAnoInicio($formacao['@attributes']['ANO-DE-INICIO']);
                    $formacaoAcademica->setAnoFim($formacao['@attributes']['ANO-DE-CONCLUSAO']);
                    $formacaoAcademica->setGrauDeFormacao($formacao['@attributes']['NIVEL']);
                    $this->entityManager->persist($formacaoAcademica);
                    $this->entityManager->flush();
                }
            } else {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayGraduacao['@attributes']['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayGraduacao['@attributes']['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayGraduacao['@attributes']['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayGraduacao['@attributes']['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayGraduacao['@attributes']['NIVEL']);
                $this->entityManager->persist($formacaoAcademica);
                $this->entityManager->flush();
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarFormacaoAcademicaMestrado(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset($curriculo['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO']['MESTRADO']['@attributes'])) {
            $formacaoAcademicaArrayMestrado = $curriculo['DADOS-GERAIS']
            ['FORMACAO-ACADEMICA-TITULACAO']['MESTRADO']['@attributes'];

            if (!is_null($formacaoAcademicaArrayMestrado)) {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayMestrado['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayMestrado['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayMestrado['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayMestrado['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayMestrado['NIVEL']);$this->entityManager->persist($formacaoAcademica);
                $this->entityManager->flush();
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarFormacaoAcademicaDoutorado(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset($curriculo['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO']['DOUTORADO']['@attributes'])) {
            $formacaoAcademicaArrayDoutorado = $curriculo['DADOS-GERAIS']
            ['FORMACAO-ACADEMICA-TITULACAO']['DOUTORADO']['@attributes'];
            if (!is_null($formacaoAcademicaArrayDoutorado)) {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayDoutorado['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayDoutorado['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayDoutorado['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayDoutorado['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayDoutorado['NIVEL']);$this->entityManager->persist($formacaoAcademica);
                $this->entityManager->flush();
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarFormacaoAcademica(array $curriculo, Pesquisador $pesquisador): void
    {
        $this->salvarFormacaoAcademicaGraduacao($curriculo, $pesquisador);
        $this->salvarFormacaoAcademicaMestrado($curriculo, $pesquisador);
        $this->salvarFormacaoAcademicaDoutorado($curriculo, $pesquisador);
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarTrabalhosEmEventos(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset($curriculo['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS'])) {
            $trabalhosEmEventosArray = $curriculo['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS'];
            if (!is_null($trabalhosEmEventosArray)) {
                foreach ($trabalhosEmEventosArray as $trabalhos) {
                    foreach ($trabalhos as $trabalho) {
                        $trabalhoEmEvento = new TrabalhosEmEventos();
                        $trabalhoEmEvento->setSequenciaProducao($trabalho['@attributes']['SEQUENCIA-PRODUCAO']);

                        $dadosBasicosDoTrabalho = $trabalho['DADOS-BASICOS-DO-TRABALHO']['@attributes'];
                        $trabalhoEmEvento->setNatureza($dadosBasicosDoTrabalho['NATUREZA']);
                        $trabalhoEmEvento->setTituloDoTrabalho($dadosBasicosDoTrabalho['TITULO-DO-TRABALHO']);
                        $trabalhoEmEvento->setAnoDoTrabalho($dadosBasicosDoTrabalho['ANO-DO-TRABALHO']);
                        $trabalhoEmEvento->setPaisDoEvento($dadosBasicosDoTrabalho['PAIS-DO-EVENTO']);
                        $trabalhoEmEvento->setIdioma($dadosBasicosDoTrabalho['IDIOMA']);
                        $trabalhoEmEvento->setMeioDeDivulgacao($dadosBasicosDoTrabalho['MEIO-DE-DIVULGACAO']);
                        $trabalhoEmEvento->setFlagRelevancia($dadosBasicosDoTrabalho['HOME-PAGE-DO-TRABALHO']);
                        $trabalhoEmEvento->setDoi($dadosBasicosDoTrabalho['DOI']);
                        $trabalhoEmEvento
                            ->setTituloDoTrabalhoIngles($dadosBasicosDoTrabalho['TITULO-DO-TRABALHO-INGLES']);
                        $trabalhoEmEvento
                            ->setFlagDivulgacaoCientifica($dadosBasicosDoTrabalho['FLAG-DIVULGACAO-CIENTIFICA']);

                        $detalhamentoDoTrabalho = $trabalho['DETALHAMENTO-DO-TRABALHO']['@attributes'];
                        $trabalhoEmEvento->setClassificacaoDoEvento($detalhamentoDoTrabalho['CLASSIFICACAO-DO-EVENTO']);
                        $trabalhoEmEvento->setNomeDoEvento($detalhamentoDoTrabalho['NOME-DO-EVENTO']);
                        $trabalhoEmEvento->setCidadeDoEvento($detalhamentoDoTrabalho['CIDADE-DO-EVENTO']);
                        $trabalhoEmEvento->setAnoDeRealizacao($detalhamentoDoTrabalho['ANO-DE-REALIZACAO']);
                        $trabalhoEmEvento
                            ->setTituloDosAnaisOuProceedings(
                                $detalhamentoDoTrabalho['TITULO-DOS-ANAIS-OU-PROCEEDINGS']
                            );
                        $trabalhoEmEvento->setVolume($detalhamentoDoTrabalho['VOLUME']);
                        $trabalhoEmEvento->setFasciculo($detalhamentoDoTrabalho['FASCICULO']);
                        $trabalhoEmEvento->setSerie($detalhamentoDoTrabalho['SERIE']);
                        $trabalhoEmEvento->setPaginaInicial($detalhamentoDoTrabalho['PAGINA-INICIAL']);
                        $trabalhoEmEvento->setPaginaFinal($detalhamentoDoTrabalho['PAGINA-FINAL']);
                        $trabalhoEmEvento->setIsbn($detalhamentoDoTrabalho['ISBN']);
                        $trabalhoEmEvento->setNomeDaEditora($detalhamentoDoTrabalho['NOME-DA-EDITORA']);
                        $trabalhoEmEvento->setCidadeDaEditora($detalhamentoDoTrabalho['CIDADE-DA-EDITORA']);

                        if (isset($trabalho['AREAS-DO-CONHECIMENTO'])) {
                            $tamanhoDoArray = sizeof($trabalho['AREAS-DO-CONHECIMENTO']);
                            for ($x = 1; $x <= $tamanhoDoArray; $x++) {
                                $areasDoConhecimento =
                                    $trabalho['AREAS-DO-CONHECIMENTO']
                                    ['AREA-DO-CONHECIMENTO-'.$x.'']['@attributes'];

                                $areasDoConhecimentoTrabalhoEmEvento =
                                    new AreasDoConhecimentoTrabalhoEmEvento();
                                $areasDoConhecimentoTrabalhoEmEvento
                                    ->setNomeGrandeAreaDoConhecimento(
                                        $areasDoConhecimento['NOME-GRANDE-AREA-DO-CONHECIMENTO']
                                    );
                                $areasDoConhecimentoTrabalhoEmEvento
                                    ->setNomeAreaDoConhecimento(
                                        $areasDoConhecimento['NOME-DA-AREA-DO-CONHECIMENTO']
                                    );
                                $areasDoConhecimentoTrabalhoEmEvento
                                    ->setNomeDaSubAreaDoConhecimento(
                                        $areasDoConhecimento['NOME-DA-SUB-AREA-DO-CONHECIMENTO']
                                    );
                                $areasDoConhecimentoTrabalhoEmEvento
                                    ->setNomeDaEspecialidade(
                                        $areasDoConhecimento['NOME-DA-ESPECIALIDADE']
                                    );
                                $areasDoConhecimentoTrabalhoEmEvento
                                    ->setTrabalhoEmEvento($trabalhoEmEvento);

                                $this->entityManager->persist($areasDoConhecimentoTrabalhoEmEvento);
                                $this->entityManager->flush();
                            }
                        }

                        if (isset($trabalho['SETORES-DE-ATIVIDADE']['@attributes'])) {
                            $setorDeAtividadeNovo =
                                new SetoresDeAtividadeTrabalhoEmEvento();

                            if (isset($trabalho['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1'])) {
                                $setorDeAtividadeNovo
                                    ->setSetorDeAtividade1($trabalho['SETORES-DE-ATIVIDADE']
                                    ['@attributes']['SETOR-DE-ATIVIDADE-1']);
                            }

                            if (isset($trabalho['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-2'])) {
                                $setorDeAtividadeNovo
                                    ->setSetorDeAtividade2($trabalho['SETORES-DE-ATIVIDADE']
                                    ['@attributes']['SETOR-DE-ATIVIDADE-2']);
                            }

                            if (isset($trabalho['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-3'])) {
                                $setorDeAtividadeNovo
                                    ->setSetorDeAtividade3($trabalho['SETORES-DE-ATIVIDADE']
                                    ['@attributes']['SETOR-DE-ATIVIDADE-3']);
                            }
                            $setorDeAtividadeNovo->setTrabalhoEmEvento($trabalhoEmEvento);
                            
                            $this->entityManager->persist($setorDeAtividadeNovo);
                            $this->entityManager->flush();
                        }

                        $trabalhoEmEvento->setPesquisador($pesquisador);
                        
                        $this->entityManager->persist($trabalhoEmEvento);
                        $this->entityManager->flush();

                        $autores = $trabalho['AUTORES'];
                        foreach ($autores as $autor) {
                            if (isset($autor['@attributes'])) {
                                $autorTrabalhoEvento = new AutoresTrabalhosEmEventos();
                                $autorTrabalhoEvento
                                    ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);
                                $autorTrabalhoEvento->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                                $autorTrabalhoEvento->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                                $autorTrabalhoEvento->setTrabalho($trabalhoEmEvento);
                                
                                $this->entityManager->persist($autorTrabalhoEvento);
                                $this->entityManager->flush();
                            } else {
                                $autorTrabalhoEvento = new AutoresTrabalhosEmEventos();
                                $autorTrabalhoEvento->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                                $autorTrabalhoEvento->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                                $autorTrabalhoEvento->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                                $autorTrabalhoEvento->setTrabalho($trabalhoEmEvento);
                                
                                $this->entityManager->persist($autorTrabalhoEvento);
                                $this->entityManager->flush();
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarArtigosPublicados(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset($curriculo['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'])) {
            $artigosPublicados = $curriculo['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'];
            if (!is_null($artigosPublicados)) {
                foreach ($artigosPublicados as $artigo) {
                    $artigoPublicado = new ArtigosPublicados();

                    $dadosBasicosDoArtigo = $artigo['DADOS-BASICOS-DO-ARTIGO']['@attributes'];
                    $artigoPublicado->setSequenciaProducao($artigo['@attributes']['SEQUENCIA-PRODUCAO']);
                    $artigoPublicado->setNatureza($dadosBasicosDoArtigo['NATUREZA']);
                    $artigoPublicado->setTituloDoArtigo($dadosBasicosDoArtigo['TITULO-DO-ARTIGO']);
                    $artigoPublicado->setAnoDoArtigo($dadosBasicosDoArtigo['ANO-DO-ARTIGO']);
                    $artigoPublicado->setPaisDePublicacao($dadosBasicosDoArtigo['PAIS-DE-PUBLICACAO']);
                    $artigoPublicado->setIdioma($dadosBasicosDoArtigo['IDIOMA']);
                    $artigoPublicado->setMeioDeDivulgacao($dadosBasicosDoArtigo['MEIO-DE-DIVULGACAO']);
                    $artigoPublicado->setFlagRelevancia($dadosBasicosDoArtigo['FLAG-RELEVANCIA']);
                    $artigoPublicado->setDoi($dadosBasicosDoArtigo['DOI']);
                    $artigoPublicado->setTituloArtigoEmIngles($dadosBasicosDoArtigo['TITULO-DO-ARTIGO-INGLES']);
                    $artigoPublicado->setFlagDivulgacaoCientifca($dadosBasicosDoArtigo['FLAG-DIVULGACAO-CIENTIFICA']);

                    $detalhamentoDoArtigo = $artigo['DETALHAMENTO-DO-ARTIGO']['@attributes'];
                    $artigoPublicado
                        ->setTituloDoPeriodicoOuRevista($detalhamentoDoArtigo['TITULO-DO-PERIODICO-OU-REVISTA']);
                    $artigoPublicado->setIssn($detalhamentoDoArtigo['ISSN']);
                    $artigoPublicado->setVolume($detalhamentoDoArtigo['VOLUME']);
                    $artigoPublicado->setFasciculo($detalhamentoDoArtigo['FASCICULO']);
                    $artigoPublicado->setSerie($detalhamentoDoArtigo['SERIE']);
                    $artigoPublicado->setPaginaInicial($detalhamentoDoArtigo['PAGINA-INICIAL']);
                    $artigoPublicado->setPaginaFinal($detalhamentoDoArtigo['PAGINA-FINAL']);
                    $artigoPublicado->setLocalDePublicacao($detalhamentoDoArtigo['LOCAL-DE-PUBLICACAO']);

                    if (isset($artigo['INFORMACOES-ADICIONAIS']['@attributes']['DESCRICAO-INFORMACOES-ADICIONAIS'])) {
                        $artigoPublicado
                            ->setInformacaoAdicional(
                                $artigo['INFORMACOES-ADICIONAIS']['@attributes']['DESCRICAO-INFORMACOES-ADICIONAIS']
                            );
                    }

                    $artigoPublicado->setPesquisador($pesquisador);
                    
                    $this->entityManager->persist($artigoPublicado);
                    $this->entityManager->flush();

                    if (isset($artigo['SETORES-DE-ATIVIDADE']['@attributes'])) {
                        $setorDeAtividadeNovo =
                            new SetoresDeAtividadeArtigosPublicados();

                        if (isset($artigo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1'])) {
                            $setorDeAtividadeNovo
                                ->setSetorDeAtividade1($artigo['SETORES-DE-ATIVIDADE']
                                ['@attributes']['SETOR-DE-ATIVIDADE-1']);
                        }

                        if (isset($artigo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-2'])) {
                            $setorDeAtividadeNovo
                                ->setSetorDeAtividade2($artigo['SETORES-DE-ATIVIDADE']
                                ['@attributes']['SETOR-DE-ATIVIDADE-2']);
                        }

                        if (isset($artigo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-3'])) {
                            $setorDeAtividadeNovo
                                ->setSetorDeAtividade3($artigo['SETORES-DE-ATIVIDADE']
                                ['@attributes']['SETOR-DE-ATIVIDADE-3']);
                        }
                        $setorDeAtividadeNovo->setArtigoPublicado($artigoPublicado);
                        
                        $this->entityManager->persist($setorDeAtividadeNovo);
                        $this->entityManager->flush();
                    }

                    if (isset($artigo['AREAS-DO-CONHECIMENTO'])) {
                        $tamanhoDoArray = sizeof($artigo['AREAS-DO-CONHECIMENTO']);
                        for ($x = 1; $x <= $tamanhoDoArray; $x++) {
                            $areasDoConhecimentoArtigo =
                                $artigo['AREAS-DO-CONHECIMENTO']['AREA-DO-CONHECIMENTO-'.$x.'']['@attributes'];

                            $areaConhecimentoArtigoNovo = new AreasDoConhecimentoArtigo();
                            $areaConhecimentoArtigoNovo
                                ->setNomeGrandeAreaDoConhecimento(
                                    $areasDoConhecimentoArtigo['NOME-GRANDE-AREA-DO-CONHECIMENTO']
                                );
                            $areaConhecimentoArtigoNovo
                                ->setNomeDaAreaDoConhecimento(
                                    $areasDoConhecimentoArtigo['NOME-DA-AREA-DO-CONHECIMENTO']
                                );
                            $areaConhecimentoArtigoNovo
                                ->setNomeDaSubAreaDoConhecimento(
                                    $areasDoConhecimentoArtigo['NOME-DA-SUB-AREA-DO-CONHECIMENTO']
                                );
                            $areaConhecimentoArtigoNovo
                                ->setNomeDaEspecialidade(
                                    $areasDoConhecimentoArtigo['NOME-DA-ESPECIALIDADE']
                                );
                            $areaConhecimentoArtigoNovo->setTrabalho($artigoPublicado);

                            $this->entityManager->persist($areaConhecimentoArtigoNovo);
                            $this->entityManager->flush();
                        }
                    }

                    $autores = $artigo['AUTORES'];
                    foreach ($autores as $autor) {
                        if (isset($autor['@attributes'])) {
                            $autorArtigoPublicado = new AutoresArtigosPublicados();
                            $autorArtigoPublicado
                                ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);
                            $autorArtigoPublicado->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                            $autorArtigoPublicado->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                            $autorArtigoPublicado->setTrabalho($artigoPublicado);
                            
                            $this->entityManager->persist($autorArtigoPublicado);
                            $this->entityManager->flush();
                        } else {
                            $autorArtigoPublicado = new AutoresArtigosPublicados();
                            $autorArtigoPublicado->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                            $autorArtigoPublicado->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                            $autorArtigoPublicado->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                            $autorArtigoPublicado->setTrabalho($artigoPublicado);
                            
                            $this->entityManager->persist($autorArtigoPublicado);
                            $this->entityManager->flush();
                        }
                    }
                }
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarCapituloDeLivroPublicado(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset($curriculo['PRODUCAO-BIBLIOGRAFICA']['LIVROS-E-CAPITULOS']
            ['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO'])) {
            $capitulos = $curriculo['PRODUCAO-BIBLIOGRAFICA']['LIVROS-E-CAPITULOS']
            ['CAPITULOS-DE-LIVROS-PUBLICADOS']['CAPITULO-DE-LIVRO-PUBLICADO'];

            foreach ($capitulos as $capitulo) {
                $capituloDeLivro = new CapituloDeLivroPublicado();
                $capituloDeLivro->setSequenciaProducao($capitulo['@attributes']['SEQUENCIA-PRODUCAO']);

                $dadosBasicosDoCapitulo = $capitulo['DADOS-BASICOS-DO-CAPITULO']['@attributes'];
                $capituloDeLivro->setTipo($dadosBasicosDoCapitulo['TIPO']);
                $capituloDeLivro->setTituloDoCapituloDoLivro($dadosBasicosDoCapitulo['TITULO-DO-CAPITULO-DO-LIVRO']);
                $capituloDeLivro->setAno($dadosBasicosDoCapitulo['ANO']);
                $capituloDeLivro->setPaisDePublicacao($dadosBasicosDoCapitulo['PAIS-DE-PUBLICACAO']);
                $capituloDeLivro->setIdioma($dadosBasicosDoCapitulo['IDIOMA']);
                $capituloDeLivro->setMeioDeDivulgacao($dadosBasicosDoCapitulo['MEIO-DE-DIVULGACAO']);
                $capituloDeLivro->setFlagDeRelevancia($dadosBasicosDoCapitulo['FLAG-RELEVANCIA']);
                $capituloDeLivro->setDoi($dadosBasicosDoCapitulo['DOI']);
                $capituloDeLivro
                    ->setTituloDoCapituloDoLivroIngles($dadosBasicosDoCapitulo['TITULO-DO-CAPITULO-DO-LIVRO-INGLES']);
                $capituloDeLivro->setFlagDivulgacaoCientifica($dadosBasicosDoCapitulo['FLAG-DIVULGACAO-CIENTIFICA']);

                $detalhamentoDoCapitulo = $capitulo['DETALHAMENTO-DO-CAPITULO']['@attributes'];
                $capituloDeLivro->setTituloDoLivro($detalhamentoDoCapitulo['TITULO-DO-LIVRO']);
                $capituloDeLivro->setNumeroDeVolumes($detalhamentoDoCapitulo['NUMERO-DE-VOLUMES']);
                $capituloDeLivro->setPaginaInicial($detalhamentoDoCapitulo['PAGINA-INICIAL']);
                $capituloDeLivro->setPaginaFinal($detalhamentoDoCapitulo['PAGINA-FINAL']);
                $capituloDeLivro->setIsbn($detalhamentoDoCapitulo['ISBN']);
                $capituloDeLivro->setOrganizadores($detalhamentoDoCapitulo['ORGANIZADORES']);
                $capituloDeLivro->setNumeroDaEdicaoRevisao($detalhamentoDoCapitulo['NUMERO-DA-EDICAO-REVISAO']);
                $capituloDeLivro->setNumeroDaSerie($detalhamentoDoCapitulo['NUMERO-DA-SERIE']);
                $capituloDeLivro->setCidadeDaEditora($detalhamentoDoCapitulo['CIDADE-DA-EDITORA']);
                $capituloDeLivro->setNomeDaEditora($detalhamentoDoCapitulo['NOME-DA-EDITORA']);

                $capituloDeLivro
                    ->setInformacaoAdicional(
                        $capitulo['INFORMACOES-ADICIONAIS']['@attributes']['DESCRICAO-INFORMACOES-ADICIONAIS']
                    );

                $autores = $capitulo['AUTORES'];
                foreach ($autores as $autor) {
                    if (isset($autor['@attributes'])) {
                        $autorCapitulo = new AutoresCapituloDeLivroPublicado();
                        $autorCapitulo
                            ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);
                        $autorCapitulo->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                        $autorCapitulo->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                        $autorCapitulo->setCapitulo($capituloDeLivro);
                        
                        $this->entityManager->persist($autorCapitulo);
                        $this->entityManager->flush();
                    } else {
                        $autorCapitulo = new AutoresCapituloDeLivroPublicado();
                        $autorCapitulo->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                        $autorCapitulo->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                        $autorCapitulo->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                        $autorCapitulo->setCapitulo($capituloDeLivro);
                        
                        $this->entityManager->persist($autorCapitulo);
                        $this->entityManager->flush();
                    }
                }

                if (isset($capitulo['AREAS-DO-CONHECIMENTO'])) {
                    $tamanhoDoArray = sizeof($capitulo['AREAS-DO-CONHECIMENTO']);
                    for ($x = 1; $x <= $tamanhoDoArray; $x++) {
                        $areasDoConhecimentoCapitulo =
                            $capitulo['AREAS-DO-CONHECIMENTO']['AREA-DO-CONHECIMENTO-'.$x.'']['@attributes'];

                        $areaConhecimentoCapituloNovo = new AreasDoConhecimentoCapituloDeLivro();
                        $areaConhecimentoCapituloNovo
                            ->setNomeGrandeAreaDoConhecimento(
                                $areasDoConhecimentoCapitulo['NOME-GRANDE-AREA-DO-CONHECIMENTO']
                            );
                        $areaConhecimentoCapituloNovo
                            ->setNomeDaAreaDoConhecimento(
                                $areasDoConhecimentoCapitulo['NOME-DA-AREA-DO-CONHECIMENTO']
                            );
                        $areaConhecimentoCapituloNovo
                            ->setNomeDaSubAreaDoConhecimento(
                                $areasDoConhecimentoCapitulo['NOME-DA-SUB-AREA-DO-CONHECIMENTO']
                            );
                        $areaConhecimentoCapituloNovo
                            ->setNomeDaEspecialidade(
                                $areasDoConhecimentoCapitulo['NOME-DA-ESPECIALIDADE']
                            );
                        $areaConhecimentoCapituloNovo->setCapitulo($capituloDeLivro);

                        $this->entityManager->persist($areaConhecimentoCapituloNovo);
                        $this->entityManager->flush();
                    }
                }


                if (isset($capitulo['SETORES-DE-ATIVIDADE']['@attributes'])) {
                    $setorDeAtividadeNovo =
                        new SetoresDeAtividadeCapituloDeLivroPublicado();

                    if (isset($capitulo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade1($capitulo['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-1']);
                    }

                    if (isset($capitulo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-2'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade2($capitulo['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-2']);
                    }

                    if (isset($capitulo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-3'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade3($capitulo['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-3']);
                    }
                    $setorDeAtividadeNovo->setCapituloDeLivroPublicado($capituloDeLivro);
                    
                    $this->entityManager->persist($setorDeAtividadeNovo);
                    $this->entityManager->flush();
                }

                $capituloDeLivro->setPesquisador($pesquisador);$this->entityManager->persist($capituloDeLivro);
                $this->entityManager->flush();
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarTextoEmJornalOuRevista(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset(
            $curriculo['PRODUCAO-BIBLIOGRAFICA']['TEXTOS-EM-JORNAIS-OU-REVISTAS']['TEXTO-EM-JORNAL-OU-REVISTA'])) {
            $textosEmJornaisOuRevistas = $curriculo['PRODUCAO-BIBLIOGRAFICA']
            ['TEXTOS-EM-JORNAIS-OU-REVISTAS']['TEXTO-EM-JORNAL-OU-REVISTA'];

            foreach ($textosEmJornaisOuRevistas as $textoEmJornalOuRevista) {
                $novoTextoEmJornalOuRevista = new TextoEmJornalOuRevistaPublicado();
                $novoTextoEmJornalOuRevista->setSequenciaProducao(
                    $textoEmJornalOuRevista['@attributes']['SEQUENCIA-PRODUCAO']
                );

                $dadosBasicosDoTexto = $textoEmJornalOuRevista['DADOS-BASICOS-DO-TEXTO']['@attributes'];
                $novoTextoEmJornalOuRevista->setNatureza($dadosBasicosDoTexto['NATUREZA']);
                $novoTextoEmJornalOuRevista->setTituloDoTexto($dadosBasicosDoTexto['TITULO-DO-TEXTO']);
                $novoTextoEmJornalOuRevista->setAnoDoTexto($dadosBasicosDoTexto['ANO-DO-TEXTO']);
                $novoTextoEmJornalOuRevista->setPaisDePublicacao($dadosBasicosDoTexto['PAIS-DE-PUBLICACAO']);
                $novoTextoEmJornalOuRevista->setIdioma($dadosBasicosDoTexto['IDIOMA']);
                $novoTextoEmJornalOuRevista->setMeioDeDivulgacao($dadosBasicosDoTexto['MEIO-DE-DIVULGACAO']);
                $novoTextoEmJornalOuRevista->setFlagRelevancia($dadosBasicosDoTexto['FLAG-RELEVANCIA']);
                $novoTextoEmJornalOuRevista->setDoi($dadosBasicosDoTexto['DOI']);
                $novoTextoEmJornalOuRevista->setTituloDoTextoEmIngles($dadosBasicosDoTexto['TITULO-DO-TEXTO-INGLES']);
                $novoTextoEmJornalOuRevista
                    ->setFlagDivulgacaoCientifica($dadosBasicosDoTexto['FLAG-DIVULGACAO-CIENTIFICA']);

                $detalhamentoDoTexto = $textoEmJornalOuRevista['DETALHAMENTO-DO-TEXTO']['@attributes'];
                $novoTextoEmJornalOuRevista
                    ->setTituloDoJornalOuRevista($detalhamentoDoTexto['TITULO-DO-JORNAL-OU-REVISTA']);
                $novoTextoEmJornalOuRevista->setIssn($detalhamentoDoTexto['ISSN']);
                $novoTextoEmJornalOuRevista
                    ->setFormatoDataDePublicacao($detalhamentoDoTexto['FORMATO-DATA-DE-PUBLICACAO']);
                $novoTextoEmJornalOuRevista->setDataDePublicacao($detalhamentoDoTexto['DATA-DE-PUBLICACAO']);
                $novoTextoEmJornalOuRevista->setVolume($detalhamentoDoTexto['VOLUME']);
                $novoTextoEmJornalOuRevista->setPaginaInicial($detalhamentoDoTexto['PAGINA-INICIAL']);
                $novoTextoEmJornalOuRevista->setPaginaFinal($detalhamentoDoTexto['PAGINA-FINAL']);
                $novoTextoEmJornalOuRevista->setLocalDePublicacao($detalhamentoDoTexto['LOCAL-DE-PUBLICACAO']);

                $autores = $textoEmJornalOuRevista['AUTORES'];
                foreach ($autores as $autor) {
                    if (isset($autor['@attributes'])) {
                        $autorTexto = new AutoresTextoEmJornalOuRevista();
                        $autorTexto
                            ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);
                        $autorTexto->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                        $autorTexto->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                        $autorTexto->setTextoEmJornalOuRevista($novoTextoEmJornalOuRevista);
                        
                        $this->entityManager->persist($autorTexto);
                        $this->entityManager->flush();
                    } else {
                        $autorTexto = new AutoresTextoEmJornalOuRevista();
                        $autorTexto->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                        $autorTexto->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                        $autorTexto->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                        $autorTexto->setTextoEmJornalOuRevista($novoTextoEmJornalOuRevista);
                        
                        $this->entityManager->persist($autorTexto);
                        $this->entityManager->flush();
                    }
                }

                if (isset($textoEmJornalOuRevista['AREAS-DO-CONHECIMENTO'])) {
                    $tamanhoDoArray = sizeof($textoEmJornalOuRevista['AREAS-DO-CONHECIMENTO']);
                    for ($x = 1; $x <= $tamanhoDoArray; $x++) {
                        $areasDoConhecimentoTexto =
                            $textoEmJornalOuRevista['AREAS-DO-CONHECIMENTO']['AREA-DO-CONHECIMENTO-'.$x.'']['@attributes'];

                        $areaConhecimentoTextoNovo = new AreasDoConhecimentoTextoEmJornalOuRevista();
                        $areaConhecimentoTextoNovo
                            ->setNomeGrandeAreaDoConhecimento(
                                $areasDoConhecimentoTexto['NOME-GRANDE-AREA-DO-CONHECIMENTO']
                            );
                        $areaConhecimentoTextoNovo
                            ->setNomeDaAreaDoConhecimento(
                                $areasDoConhecimentoTexto['NOME-DA-AREA-DO-CONHECIMENTO']
                            );
                        $areaConhecimentoTextoNovo
                            ->setNomeDaSubAreaDoConhecimento(
                                $areasDoConhecimentoTexto['NOME-DA-SUB-AREA-DO-CONHECIMENTO']
                            );
                        $areaConhecimentoTextoNovo
                            ->setNomeDaEspecialidade(
                                $areasDoConhecimentoTexto['NOME-DA-ESPECIALIDADE']
                            );
                        $areaConhecimentoTextoNovo->setTextoEmJornalOuRevista($novoTextoEmJornalOuRevista);

                        $this->entityManager->persist($areaConhecimentoTextoNovo);
                        $this->entityManager->flush();
                    }
                }


                $novoTextoEmJornalOuRevista->setInformacaoAdicional(
                    $textoEmJornalOuRevista['INFORMACOES-ADICIONAIS']['@attributes']['DESCRICAO-INFORMACOES-ADICIONAIS']
                );

                if (isset($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']['@attributes'])) {
                    $setorDeAtividadeNovo =
                        new SetoresDeAtividadeTextoEmJornalOuRevista();

                    if (isset($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']['@attributes']
                        ['SETOR-DE-ATIVIDADE-1'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade1($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-1']);
                    }

                    if (isset($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']['@attributes']
                        ['SETOR-DE-ATIVIDADE-2'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade2($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-2']);
                    }

                    if (isset($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']['@attributes']
                        ['SETOR-DE-ATIVIDADE-3'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade3($textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-3']);
                    }
                    $setorDeAtividadeNovo->setTextoEmJornalOuRevista($novoTextoEmJornalOuRevista);
                    
                    $this->entityManager->persist($setorDeAtividadeNovo);
                    $this->entityManager->flush();
                }

                $novoTextoEmJornalOuRevista->setPesquisador($pesquisador);$this->entityManager->persist($novoTextoEmJornalOuRevista);
                $this->entityManager->flush();
            }
        }
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     */
    public function salvarArtigoAceitoParaPublicacao(array $curriculo, Pesquisador $pesquisador): void
    {
        if (isset(
            $curriculo['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-ACEITOS-PARA-PUBLICACAO']['ARTIGO-ACEITO-PARA-PUBLICACAO'])) {
            $artigosAceitosParaPublicacao =
                $curriculo['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-ACEITOS-PARA-PUBLICACAO']['ARTIGO-ACEITO-PARA-PUBLICACAO'];
            $curriculo['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-ACEITOS-PARA-PUBLICACAO']['ARTIGO-ACEITO-PARA-PUBLICACAO'];
            foreach ($artigosAceitosParaPublicacao as $artigoAceitoParaPublicacao) {
                $novoArtigoAceitoParaPublicacao = new ArtigoAceitoParaPublicacao();
                $novoArtigoAceitoParaPublicacao
                    ->setSequenciaProducao($artigoAceitoParaPublicacao['@attributes']['SEQUENCIA-PRODUCAO']);

                $dadosBasicosDoArtigo = $artigoAceitoParaPublicacao['DADOS-BASICOS-DO-ARTIGO']['@attributes'];
                $novoArtigoAceitoParaPublicacao->setNatureza($dadosBasicosDoArtigo['NATUREZA']);
                $novoArtigoAceitoParaPublicacao->setTituloDoArtigo($dadosBasicosDoArtigo['TITULO-DO-ARTIGO']);
                $novoArtigoAceitoParaPublicacao->setAnoDoArtigo($dadosBasicosDoArtigo['ANO-DO-ARTIGO']);
                $novoArtigoAceitoParaPublicacao->setPaisDePublicacao($dadosBasicosDoArtigo['PAIS-DE-PUBLICACAO']);
                $novoArtigoAceitoParaPublicacao->setIdioma($dadosBasicosDoArtigo['IDIOMA']);
                $novoArtigoAceitoParaPublicacao->setMeioDeDivulgacao($dadosBasicosDoArtigo['MEIO-DE-DIVULGACAO']);
                $novoArtigoAceitoParaPublicacao->setFlagRelevancia($dadosBasicosDoArtigo['FLAG-RELEVANCIA']);
                $novoArtigoAceitoParaPublicacao->setDoi($dadosBasicosDoArtigo['DOI']);
                $novoArtigoAceitoParaPublicacao
                    ->setTituloDoArtigoEmIngles($dadosBasicosDoArtigo['TITULO-DO-ARTIGO-INGLES']);
                $novoArtigoAceitoParaPublicacao
                    ->setFlagDivulgacaoCientifica($dadosBasicosDoArtigo['FLAG-DIVULGACAO-CIENTIFICA']);

                $detalhamentoDoArtigo = $artigoAceitoParaPublicacao['DETALHAMENTO-DO-ARTIGO']['@attributes'];
                $novoArtigoAceitoParaPublicacao
                    ->setTituloDoPeriodicoOuRevista($detalhamentoDoArtigo['TITULO-DO-PERIODICO-OU-REVISTA']);
                $novoArtigoAceitoParaPublicacao->setIssn($detalhamentoDoArtigo['ISSN']);
                $novoArtigoAceitoParaPublicacao->setVolume($detalhamentoDoArtigo['VOLUME']);
                $novoArtigoAceitoParaPublicacao->setFasciculo($detalhamentoDoArtigo['FASCICULO']);
                $novoArtigoAceitoParaPublicacao->setSerie($detalhamentoDoArtigo['SERIE']);
                $novoArtigoAceitoParaPublicacao->setPaginaInicial($detalhamentoDoArtigo['PAGINA-INICIAL']);
                $novoArtigoAceitoParaPublicacao->setPaginaFinal($detalhamentoDoArtigo['PAGINA-FINAL']);
                $novoArtigoAceitoParaPublicacao->setLocalDePublicacao($detalhamentoDoArtigo['LOCAL-DE-PUBLICACAO']);

                $autores = $artigoAceitoParaPublicacao['AUTORES'];
                foreach ($autores as $autor) {
                    if (isset($autor['@attributes'])) {
                        $autorArtigoAceitoParaPublicacao = new AutoresArtigoAceitoParaPublicacao();
                        $autorArtigoAceitoParaPublicacao
                            ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);
                        $autorArtigoAceitoParaPublicacao
                            ->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                        $autorArtigoAceitoParaPublicacao->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                        $autorArtigoAceitoParaPublicacao
                            ->setArtigoAceitoParaPublicacao($novoArtigoAceitoParaPublicacao);
                        
                        $this->entityManager->persist($autorArtigoAceitoParaPublicacao);
                        $this->entityManager->flush();
                    } else {
                        $autorArtigoAceitoParaPublicacao = new AutoresArtigoAceitoParaPublicacao();
                        $autorArtigoAceitoParaPublicacao->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                        $autorArtigoAceitoParaPublicacao->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                        $autorArtigoAceitoParaPublicacao->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                        $autorArtigoAceitoParaPublicacao
                            ->setArtigoAceitoParaPublicacao($novoArtigoAceitoParaPublicacao);
                        
                        $this->entityManager->persist($autorArtigoAceitoParaPublicacao);
                        $this->entityManager->flush();
                    }
                }

                if (isset($artigoAceitoParaPublicacao['AREAS-DO-CONHECIMENTO'])) {
                    $tamanhoDoArray = sizeof($artigoAceitoParaPublicacao['AREAS-DO-CONHECIMENTO']);
                    for ($x = 1; $x <= $tamanhoDoArray; $x++) {
                        $areasDoConhecimentoArtigoAceitoParaPublicacao =
                            $artigoAceitoParaPublicacao['AREAS-DO-CONHECIMENTO']
                            ['AREA-DO-CONHECIMENTO-'.$x.'']['@attributes'];

                        $areasDoConhecimentoArtigoAceitoParaPublicacaoNovo =
                            new AreasDoConhecimentoArtigoAceitoParaPublicacao();
                        $areasDoConhecimentoArtigoAceitoParaPublicacaoNovo
                            ->setNomeGrandeAreaDoConhecimento(
                                $areasDoConhecimentoArtigoAceitoParaPublicacao['NOME-GRANDE-AREA-DO-CONHECIMENTO']
                            );
                        $areasDoConhecimentoArtigoAceitoParaPublicacaoNovo
                            ->setNomeDaAreaDoConhecimento(
                                $areasDoConhecimentoArtigoAceitoParaPublicacao['NOME-DA-AREA-DO-CONHECIMENTO']
                            );
                        $areasDoConhecimentoArtigoAceitoParaPublicacaoNovo
                            ->setNomeDaSubAreaDoConhecimento(
                                $areasDoConhecimentoArtigoAceitoParaPublicacao['NOME-DA-SUB-AREA-DO-CONHECIMENTO']
                            );
                        $areasDoConhecimentoArtigoAceitoParaPublicacaoNovo
                            ->setNomeDaEspecialidade(
                                $areasDoConhecimentoArtigoAceitoParaPublicacao['NOME-DA-ESPECIALIDADE']
                            );
                        $areasDoConhecimentoArtigoAceitoParaPublicacaoNovo
                            ->setArtigoAceitoParaPublicacao($novoArtigoAceitoParaPublicacao);

                        $this->entityManager->persist($areasDoConhecimentoArtigoAceitoParaPublicacaoNovo);
                        $this->entityManager->flush();
                    }
                }

                if (isset($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']['@attributes'])) {
                    $setorDeAtividadeNovo =
                        new SetoresDeAtividadeArtigoAceitoParaPublicacao();

                    if (isset($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']['@attributes']
                        ['SETOR-DE-ATIVIDADE-1'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade1($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-1']);
                    }

                    if (isset($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']['@attributes']
                        ['SETOR-DE-ATIVIDADE-2'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade2($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-2']);
                    }

                    if (isset($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']['@attributes']
                        ['SETOR-DE-ATIVIDADE-3'])) {
                        $setorDeAtividadeNovo
                            ->setSetorDeAtividade3($artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']
                            ['@attributes']['SETOR-DE-ATIVIDADE-3']);
                    }
                    $setorDeAtividadeNovo->setArtigoAceitoParaPublicacao($novoArtigoAceitoParaPublicacao);
                    
                    $this->entityManager->persist($setorDeAtividadeNovo);
                    $this->entityManager->flush();
                }

                $novoArtigoAceitoParaPublicacao->setPesquisador($pesquisador);$this->entityManager->persist($novoArtigoAceitoParaPublicacao);
                $this->entityManager->flush();
            }
        }
    }
}