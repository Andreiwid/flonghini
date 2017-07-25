<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AreasDoConhecimentoArtigo;
use AppBundle\Entity\AreasDoConhecimentoArtigoAceitoParaPublicacao;
use AppBundle\Entity\AreasDoConhecimentoCapituloDeLivro;
use AppBundle\Entity\AreasDoConhecimentoTextoEmJornalOuRevista;
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
use AppBundle\Entity\TextoEmJornalOuRevistaPublicado;
use AppBundle\Entity\TrabalhosEmEventos;
use AppBundle\Services\DefaultService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;


class DefaultController extends Controller
{
    /**
     * @var DefaultService
     */
    private $defaultService;

    /**
     * DefaultController constructor.
     * @param DefaultService $defaultService
     */
    public function __construct(DefaultService $defaultService)
    {
        $this->defaultService = $defaultService;
    }


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $finder = new Finder();
        $finder->files()->in('/home/francisco/projetos/proj/xml');

        foreach ($finder as $file) {
            $cv = new \SimpleXMLElement($file->getContents());
            $json = json_encode($cv);
            $curriculo = json_decode($json, true);
        }

        $pesquisador = $this->salvarPesquisador($curriculo);
        $this->salvarFormacaoAcademica($curriculo, $pesquisador);
        $this->salvarTrabalhosEmEventos($curriculo, $pesquisador);
        $this->salvarArtigosPublicados($curriculo, $pesquisador);
        $this->salvarCapituloDeLivroPublicado($curriculo, $pesquisador);
        $this->salvarTextoEmJornalOuRevista($curriculo, $pesquisador);
        $this->salvarArtigoAceitoParaPublicacao($curriculo, $pesquisador);

        return $this->render(
            'default/index.html.twig',
            [
                'file' => $finder
            ]
        );
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
        $em = $this->getDoctrine()->getManager();
        $em->persist($pesquisador);
        $em->flush();
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
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($formacaoAcademica);
                    $em->flush();
                }
            } else {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayGraduacao['@attributes']['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayGraduacao['@attributes']['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayGraduacao['@attributes']['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayGraduacao['@attributes']['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayGraduacao['@attributes']['NIVEL']);
                $em = $this->getDoctrine()->getManager();
                $em->persist($formacaoAcademica);
                $em->flush();
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
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayMestrado['NIVEL']);
                $em = $this->getDoctrine()->getManager();
                $em->persist($formacaoAcademica);
                $em->flush();
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
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayDoutorado['NIVEL']);
                $em = $this->getDoctrine()->getManager();
                $em->persist($formacaoAcademica);
                $em->flush();
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

                        $areasDoConhecimento =
                            $trabalho['AREAS-DO-CONHECIMENTO']['AREA-DO-CONHECIMENTO-1']['@attributes'];
                        $trabalhoEmEvento
                            ->setNomeGrandeAreaDoConhecimento($areasDoConhecimento['NOME-GRANDE-AREA-DO-CONHECIMENTO']);
                        $trabalhoEmEvento
                            ->setNomeAreaDoConhecimento($areasDoConhecimento['NOME-DA-AREA-DO-CONHECIMENTO']);
                        $trabalhoEmEvento
                            ->setNomeDaSubAreaDoConhecimento($areasDoConhecimento['NOME-DA-SUB-AREA-DO-CONHECIMENTO']);
                        $trabalhoEmEvento->setNomeDaEspecialidade($areasDoConhecimento['NOME-DA-ESPECIALIDADE']);
                        $trabalhoEmEvento->setPesquisador($pesquisador);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($trabalhoEmEvento);
                        $em->flush();

                        $autores = $trabalho['AUTORES'];
                        foreach ($autores as $autor) {
                            if (isset($autor['@attributes'])) {
                                $autorTrabalhoEvento = new AutoresTrabalhosEmEventos();
                                $autorTrabalhoEvento
                                    ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);
                                $autorTrabalhoEvento->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                                $autorTrabalhoEvento->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                                $autorTrabalhoEvento->setTrabalho($trabalhoEmEvento);
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($autorTrabalhoEvento);
                                $em->flush();
                            } else {
                                $autorTrabalhoEvento = new AutoresTrabalhosEmEventos();
                                $autorTrabalhoEvento->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                                $autorTrabalhoEvento->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                                $autorTrabalhoEvento->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                                $autorTrabalhoEvento->setTrabalho($trabalhoEmEvento);
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($autorTrabalhoEvento);
                                $em->flush();
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
                    $artigoPublicado
                        ->setSetoresDeAtividade($artigo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1']);
                    $artigoPublicado
                        ->setInformacaoAdicional(
                            $artigo['INFORMACOES-ADICIONAIS']['@attributes']['DESCRICAO-INFORMACOES-ADICIONAIS']
                        );

                    $artigoPublicado->setPesquisador($pesquisador);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($artigoPublicado);
                    $em->flush();

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
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($areaConhecimentoArtigoNovo);
                        $em->flush();
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
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($autorArtigoPublicado);
                            $em->flush();
                        } else {
                            $autorArtigoPublicado = new AutoresArtigosPublicados();
                            $autorArtigoPublicado->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                            $autorArtigoPublicado->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                            $autorArtigoPublicado->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                            $autorArtigoPublicado->setTrabalho($artigoPublicado);
                            $em = $this->getDoctrine()->getManager();
                            $em->persist($autorArtigoPublicado);
                            $em->flush();
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
                    ->setSetorDeAtividade($capitulo['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1']);
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
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($autorCapitulo);
                        $em->flush();
                    } else {
                        $autorCapitulo = new AutoresCapituloDeLivroPublicado();
                        $autorCapitulo->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                        $autorCapitulo->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                        $autorCapitulo->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                        $autorCapitulo->setCapitulo($capituloDeLivro);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($autorCapitulo);
                        $em->flush();
                    }
                }

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
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($areaConhecimentoCapituloNovo);
                    $em->flush();
                }
                $capituloDeLivro->setPesquisador($pesquisador);
                $em = $this->getDoctrine()->getManager();
                $em->persist($capituloDeLivro);
                $em->flush();
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
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($autorTexto);
                        $em->flush();
                    } else {
                        $autorTexto = new AutoresTextoEmJornalOuRevista();
                        $autorTexto->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                        $autorTexto->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                        $autorTexto->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                        $autorTexto->setTextoEmJornalOuRevista($novoTextoEmJornalOuRevista);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($autorTexto);
                        $em->flush();
                    }
                }

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
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($areaConhecimentoTextoNovo);
                    $em->flush();
                }

                $novoTextoEmJornalOuRevista->setSetoresDeAtividade(
                    $textoEmJornalOuRevista['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1']
                );

                $novoTextoEmJornalOuRevista->setInformacaoAdicional(
                    $textoEmJornalOuRevista['INFORMACOES-ADICIONAIS']['@attributes']['DESCRICAO-INFORMACOES-ADICIONAIS']
                );

                $novoTextoEmJornalOuRevista->setPesquisador($pesquisador);
                $em = $this->getDoctrine()->getManager();
                $em->persist($novoTextoEmJornalOuRevista);
                $em->flush();
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
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($autorArtigoAceitoParaPublicacao);
                        $em->flush();
                    } else {
                        $autorArtigoAceitoParaPublicacao = new AutoresArtigoAceitoParaPublicacao();
                        $autorArtigoAceitoParaPublicacao->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                        $autorArtigoAceitoParaPublicacao->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                        $autorArtigoAceitoParaPublicacao->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                        $autorArtigoAceitoParaPublicacao
                            ->setArtigoAceitoParaPublicacao($novoArtigoAceitoParaPublicacao);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($autorArtigoAceitoParaPublicacao);
                        $em->flush();
                    }
                }

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
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($areasDoConhecimentoArtigoAceitoParaPublicacaoNovo);
                    $em->flush();
                }

                $novoArtigoAceitoParaPublicacao
                    ->setSetoresDeAtividade(
                        $artigoAceitoParaPublicacao['SETORES-DE-ATIVIDADE']['@attributes']['SETOR-DE-ATIVIDADE-1']
                    );

                $novoArtigoAceitoParaPublicacao->setPesquisador($pesquisador);
                $em = $this->getDoctrine()->getManager();
                $em->persist($novoArtigoAceitoParaPublicacao);
                $em->flush();
            }
        }
    }

}
