<?php

namespace AppBundle\Controller;

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
//            var_dump($cv->CURRICULO-VITAE->DADOS-GERAIS);

//            $cv = simplexml_load_string($file->getContents()) or die("Error: Cannot create object");

//            foreach($cv['DADOS-GERAIS']->attributes() as $a => $b) 
//            {
//                echo $a,'="',$b,"<br>";
//            }

            $json = json_encode($cv);
            $array = json_decode($json,TRUE);
                        var_dump($array['DADOS-GERAIS']);


        }
//            var_dump($array['DADOS-GERAIS']['@attributes']['NOME-COMPLETO']);
//            var_dump($array['PRODUCAO-BIBLIOGRAFICA']['ARTIGOS-PUBLICADOS']['ARTIGO-PUBLICADO'][0]);
            die();
        return $this->render(
            'default/index.html.twig',
            [
                'file' => $finder
            ]
        );
    }

    function displayNode($node, $offset) {

        if (is_object($node)) {
            $node = get_object_vars($node);
            foreach ($node as $key => $value) {
                echo str_repeat(" ", $offset) . "-" . $key . "\n";
                $this->displayNode($value, $offset + 1);
            }
        } elseif (is_array($node)) {
            foreach ($node as $key => $value) {
                if (is_object($value))
                    $this->displayNode($value, $offset + 1);
                else
                    echo str_repeat(" ", $offset) . "-" . $key . "\n";
            }
        }
    }
}
