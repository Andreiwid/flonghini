<?php

namespace AppBundle\Services;

use AppBundle\Entity\AutoresTrabalhosEmEventos;
use AppBundle\Entity\FormacaoAcademica;
use AppBundle\Entity\Pesquisador;
use AppBundle\Entity\TrabalhosEmEventos;

class DefaultService
{
    /**
     * @param $curriculo
     * @return Pesquisador
     */
    public function setPesquisador(array $curriculo): Pesquisador
    {
        $pesquisador = new Pesquisador();
        $pesquisador->setNomeCompleto($curriculo['DADOS-GERAIS']['@attributes']['NOME-COMPLETO']);
        $pesquisador->setNacionalidade($curriculo['DADOS-GERAIS']['@attributes']['PAIS-DE-NACIONALIDADE']);
        $pesquisador->setNomeEmCitacoes($curriculo['DADOS-GERAIS']['@attributes']['NOME-EM-CITACOES-BIBLIOGRAFICAS']);
        return $pesquisador;
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     * @return FormacaoAcademica|null
     */
    public function setFormacaoAcademicaGraduacao(array $curriculo, Pesquisador $pesquisador): ?FormacaoAcademica
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
                    return $formacaoAcademica;
                }
            } else {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayGraduacao['@attributes']['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayGraduacao['@attributes']['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayGraduacao['@attributes']['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayGraduacao['@attributes']['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayGraduacao['@attributes']['NIVEL']);
                return $formacaoAcademica;
            }
        }
        return null;
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     * @return FormacaoAcademica|null
     */
    public function setFormacaoAcademicaMestrado(array $curriculo, Pesquisador $pesquisador): ?FormacaoAcademica
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
                return $formacaoAcademica;
            }
        }
        return null;
    }

    /**
     * @param array $curriculo
     * @param Pesquisador $pesquisador
     * @return FormacaoAcademica|null
     */
    public function setFormacaoAcademicaDoutorado(array $curriculo, Pesquisador $pesquisador): ?FormacaoAcademica
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
                return $formacaoAcademica;
            }
        }
        return null;
    }

    public function setTrabalhosEmEventos(array $curriculo, Pesquisador $pesquisador)
    {
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
                    $trabalhoEmEvento->setTituloDoTrabalhoIngles($dadosBasicosDoTrabalho['TITULO-DO-TRABALHO-INGLES']);
                    $trabalhoEmEvento
                        ->setFlagDivulgacaoCientifica($dadosBasicosDoTrabalho['FLAG-DIVULGACAO-CIENTIFICA']);

                    $detalhamentoDoTrabalho = $trabalho['DETALHAMENTO-DO-TRABALHO']['@attributes'];
                    $trabalhoEmEvento->setClassificacaoDoEvento($detalhamentoDoTrabalho['CLASSIFICACAO-DO-EVENTO']);
                    $trabalhoEmEvento->setNomeDoEvento($detalhamentoDoTrabalho['NOME-DO-EVENTO']);
                    $trabalhoEmEvento->setCidadeDoEvento($detalhamentoDoTrabalho['CIDADE-DO-EVENTO']);
                    $trabalhoEmEvento->setAnoDeRealizacao($detalhamentoDoTrabalho['ANO-DE-REALIZACAO']);
                    $trabalhoEmEvento
                        ->setTituloDosAnaisOuProceedings($detalhamentoDoTrabalho['TITULO-DOS-ANAIS-OU-PROCEEDINGS']);
                    $trabalhoEmEvento->setVolume($detalhamentoDoTrabalho['VOLUME']);
                    $trabalhoEmEvento->setFasciculo($detalhamentoDoTrabalho['FASCICULO']);
                    $trabalhoEmEvento->setSerie($detalhamentoDoTrabalho['SERIE']);
                    $trabalhoEmEvento->setPaginaInicial($detalhamentoDoTrabalho['PAGINA-INICIAL']);
                    $trabalhoEmEvento->setPaginaFinal($detalhamentoDoTrabalho['PAGINA-FINAL']);
                    $trabalhoEmEvento->setIsbn($detalhamentoDoTrabalho['ISBN']);
                    $trabalhoEmEvento->setNomeDaEditora($detalhamentoDoTrabalho['NOME-DA-EDITORA']);
                    $trabalhoEmEvento->setCidadeDaEditora($detalhamentoDoTrabalho['CIDADE-DA-EDITORA']);


                    $areasDoConhecimento = $trabalho['AREAS-DO-CONHECIMENTO']['AREA-DO-CONHECIMENTO-1']['@attributes'];
                    $trabalhoEmEvento
                        ->setNomeGrandeAreaDoConhecimento($areasDoConhecimento['NOME-GRANDE-AREA-DO-CONHECIMENTO']);
                    $trabalhoEmEvento->setNomeAreaDoConhecimento($areasDoConhecimento['NOME-DA-AREA-DO-CONHECIMENTO']);
                    $trabalhoEmEvento
                        ->setNomeDaSubAreaDoConhecimento($areasDoConhecimento['NOME-DA-SUB-AREA-DO-CONHECIMENTO']);
                    $trabalhoEmEvento->setNomeDaEspecialidade($areasDoConhecimento['NOME-DA-ESPECIALIDADE']);
                    $trabalhoEmEvento->setPesquisador($pesquisador);

                    return $trabalhoEmEvento;
                }
            }
        }
        return null;
    }

    public function setAutoresDeTrabalhosEmEventos(array $curriculo, TrabalhosEmEventos $trabalhoEmEvento)
    {
        $trabalhosEmEventosArray = $curriculo['PRODUCAO-BIBLIOGRAFICA']['TRABALHOS-EM-EVENTOS'];
        if (!is_null($trabalhosEmEventosArray)) {
            foreach ($trabalhosEmEventosArray as $trabalhos) {
                foreach ($trabalhos as $trabalho) {
                    $autores = $trabalho['AUTORES'];
                    foreach ($autores as $autor) {
                        if (isset($autor['@attributes'])) {
                            $autorTrabalhoEvento = new AutoresTrabalhosEmEventos();
                            $autorTrabalhoEvento
                                ->setNomeCompletoDoAutor($autor['@attributes']['NOME-COMPLETO-DO-AUTOR']);

                            $autorTrabalhoEvento->setNomeParaCitacao($autor['@attributes']['NOME-PARA-CITACAO']);
                            $autorTrabalhoEvento->setOrdemDeAutoria($autor['@attributes']['ORDEM-DE-AUTORIA']);
                            $autorTrabalhoEvento->setTrabalho($trabalhoEmEvento);
                            return $autorTrabalhoEvento;
                        } else {
                            $autorTrabalhoEvento = new AutoresTrabalhosEmEventos();
                            $autorTrabalhoEvento->setNomeCompletoDoAutor($autor['NOME-COMPLETO-DO-AUTOR']);
                            $autorTrabalhoEvento->setNomeParaCitacao($autor['NOME-PARA-CITACAO']);
                            $autorTrabalhoEvento->setOrdemDeAutoria($autor['ORDEM-DE-AUTORIA']);
                            $autorTrabalhoEvento->setTrabalho($trabalhoEmEvento);
                            return $autorTrabalhoEvento;
                        }
                    }
                }
            }
        }
        return null;
    }
}
