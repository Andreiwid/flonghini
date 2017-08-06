<?php

namespace AppBundle\Controller;

use AppBundle\Services\CurriculumService;
use AppBundle\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CurriculumController extends Controller
{
    /**
     * @var CurriculumService
     */
    private $curriculumService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * CurriculumController constructor.
     * @param CurriculumService $curriculumService
     * @param UserService $userService
     */
    public function __construct
    (
        CurriculumService $curriculumService,
        UserService $userService
    ) {
        $this->curriculumService = $curriculumService;
        $this->userService = $userService;
    }

    /**
     * @Route("/curriculo", name="curriculo")
     */
    public function indexAction(): Response
    {
        return $this->render(
            'default/index.html.twig'
        );
    }

    /**
     * @Route("/curriculo/cadastrar", name="cadastrar")
     * @return Response
     */
    public function cadastrarAction()
    {
        return $this->render(
            'curriculos/cadastrar.html.twig'
        );
    }

    /**
     * @Route("/curriculo/salvar", name="salvar_curriculo")
     * @return Response
     */
    public function saveAction(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $curriculo = $request->get('file');
            var_dump('as');
            die();

        }

        $finder = new Finder();
//        $finder->files()->in('/home/francisco/projetos/proj/xml');
        $finder->files()->in('/Users/Chico/Sites/proj/xml');

        foreach ($finder as $file) {
            $cv = new \SimpleXMLElement($file->getContents());
            $json = json_encode($cv);
            $curriculo = json_decode($json, true);
        }

        var_dump($curriculo);
        die();

//        foreach ($curriculo['DADOS-GERAIS']['FORMACAO-ACADEMICA-TITULACAO']['GRADUACAO'] as $setoresDeAtividade) {
//            var_dump((int)$setoresDeAtividade['@attributes']['NIVEL']);
//        }
//        die();

        $pesquisador = $this->curriculumService->salvarPesquisador($curriculo);
        $this->curriculumService->salvarFormacaoAcademica($curriculo, $pesquisador);
        $this->curriculumService->salvarTrabalhosEmEventos($curriculo, $pesquisador);
        $this->curriculumService->salvarArtigosPublicados($curriculo, $pesquisador);
        $this->curriculumService->salvarCapituloDeLivroPublicado($curriculo, $pesquisador);
        $this->curriculumService->salvarTextoEmJornalOuRevista($curriculo, $pesquisador);
        $this->curriculumService->salvarArtigoAceitoParaPublicacao($curriculo, $pesquisador);

        return $this->render(
            'default/index.html.twig',
            [
                'file' => $finder
            ]
        );
    }


}
