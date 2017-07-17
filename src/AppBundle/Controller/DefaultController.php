<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FormacaoAcademica;
use AppBundle\Entity\Pesquisador;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Finder\Finder;


class DefaultController extends Controller
{
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
            $cvArray = json_decode($json,TRUE);
        }

//        var_dump($cvArray['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO']['MESTRADO']);
//        die();

        $em = $this->getDoctrine()->getManager();
        $pesquisador = new Pesquisador();
        $pesquisador->setNomeCompleto($cvArray['DADOS-GERAIS']['@attributes']['NOME-COMPLETO']);
        $pesquisador->setNacionalidade($cvArray['DADOS-GERAIS']['@attributes']['PAIS-DE-NACIONALIDADE']);
        $pesquisador->setNomeEmCitacoes($cvArray['DADOS-GERAIS']['@attributes']['NOME-EM-CITACOES-BIBLIOGRAFICAS']);
        $em->persist($pesquisador);
        $em->flush();

        $formacaoAcademicaArrayGraduacao = $cvArray['DADOS-GERAIS']
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
                $em->persist($formacaoAcademica);
                $em->flush();
            }

        }

        if (isset($cvArray['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO']['MESTRADO']['@attributes'])) {
            $formacaoAcademicaArrayMestrado = $cvArray['DADOS-GERAIS']
            ['FORMACAO-ACADEMICA-TITULACAO']['MESTRADO']['@attributes'];

            if (!is_null($formacaoAcademicaArrayMestrado)) {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayMestrado['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayMestrado['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayMestrado['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayMestrado['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayMestrado['NIVEL']);
                $em->persist($formacaoAcademica);
                $em->flush();
            }
        }

        if (isset($cvArray['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO']['DOUTORADO']['@attributes'])) {
            $formacaoAcademicaArrayDoutorado = $cvArray['DADOS-GERAIS']
            ['FORMACAO-ACADEMICA-TITULACAO']['DOUTORADO']['@attributes'];
            if (!is_null($formacaoAcademicaArrayDoutorado)) {
                $formacaoAcademica = new FormacaoAcademica();
                $formacaoAcademica->setInstituicao($formacaoAcademicaArrayDoutorado['NOME-INSTITUICAO']);
                $formacaoAcademica->setPesquisador($pesquisador);
                $formacaoAcademica->setCurso($formacaoAcademicaArrayDoutorado['NOME-CURSO']);
                $formacaoAcademica->setAnoInicio($formacaoAcademicaArrayDoutorado['ANO-DE-INICIO']);
                $formacaoAcademica->setAnoFim($formacaoAcademicaArrayDoutorado['ANO-DE-CONCLUSAO']);
                $formacaoAcademica->setGrauDeFormacao($formacaoAcademicaArrayDoutorado['NIVEL']);
                $em->persist($formacaoAcademica);
                $em->flush();
            }
        }















        return $this->render(
            'default/index.html.twig',
            [
                'file' => $finder
            ]
        );
    }


















}
