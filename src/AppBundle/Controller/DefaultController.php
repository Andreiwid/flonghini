<?php

namespace AppBundle\Controller;

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

//            var_dump($cvArray['DADOS-GERAIS']);
//            var_dump($cvArray['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO']);
//            die();

        $em = $this->getDoctrine()->getManager();
        $pesquisador = new Pesquisador();
        $pesquisador->setNomeCompleto($cvArray['DADOS-GERAIS']['@attributes']['NOME-COMPLETO']);
        $pesquisador->setNacionalidade($cvArray['DADOS-GERAIS']['@attributes']['PAIS-DE-NACIONALIDADE']);
        $pesquisador->setNomeEmCitacoes($cvArray['DADOS-GERAIS']['@attributes']['NOME-EM-CITACOES-BIBLIOGRAFICAS']);


        $em->persist($pesquisador);
        $em->flush();



        return $this->render(
            'default/index.html.twig',
            [
                'file' => $finder
            ]
        );
    }


















}
