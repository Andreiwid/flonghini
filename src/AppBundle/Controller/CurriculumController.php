<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CurriculoXML;
use AppBundle\Form\CurriculoXMLType;
use AppBundle\Services\PesquisadorService;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Services\CurriculumService;
use AppBundle\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @var PesquisadorService
     */
    private $pesquisadorService;

    /**
     * CurriculumController constructor.
     * @param CurriculumService $curriculumService
     * @param UserService $userService
     * @param PesquisadorService $pesquisadorService
     */
    public function __construct
    (
        CurriculumService $curriculumService,
        UserService $userService,
        PesquisadorService $pesquisadorService
    ) {
        $this->curriculumService = $curriculumService;
        $this->userService = $userService;
        $this->pesquisadorService = $pesquisadorService;
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
    public function cadastrarAction(Request $request)
    {
        $curriculo = new CurriculoXML();
        $form = $this->createForm(CurriculoXMLType::class, $curriculo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $curriculo->getFile();
            $fileName = md5(uniqid()).'.xml';
            $file->move(
                $this->getParameter('xml_directory'),
                $fileName
            );
            $curriculo->setFile($fileName);
            $this->saveAction();
            return $this->redirect($this->generateUrl('curriculo'));
        }


        return $this->render(
            'curriculos/cadastrar.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/curriculo/listar", name="listar_curriculos")
     */
    public function listAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $pesquisador = $this->pesquisadorService->getPesquisadorByUserId($user->getId());

        var_dump($pesquisador);
        die();
        return $this->render(
            'curriculos/listar.html.twig',
            [
                'pesquisadores' => $pesquisador
            ]
        );
    }

    public function saveAction(): void
    {
        $finder = new Finder();
        $finder->files()->in('/home/francisco/projetos/proj/xml');
//        $finder->files()->in('/Users/Chico/Sites/proj/xml');

        foreach ($finder as $file) {
            $cv = new \SimpleXMLElement($file->getContents());
            $json = json_encode($cv);
            $curriculo = json_decode($json, true);
        }

        $pesquisador = $this->curriculumService->salvarPesquisador($curriculo);
        $this->curriculumService->salvarFormacaoAcademica($curriculo, $pesquisador);
        $this->curriculumService->salvarTrabalhosEmEventos($curriculo, $pesquisador);
        $this->curriculumService->salvarArtigosPublicados($curriculo, $pesquisador);
        $this->curriculumService->salvarCapituloDeLivroPublicado($curriculo, $pesquisador);
        $this->curriculumService->salvarTextoEmJornalOuRevista($curriculo, $pesquisador);
        $this->curriculumService->salvarArtigoAceitoParaPublicacao($curriculo, $pesquisador);
    }

}
