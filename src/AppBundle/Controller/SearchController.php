<?php

namespace AppBundle\Controller;

use AppBundle\Services\SearchService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $searchService;

    /**
     * SearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @Route("/busca", name="busca")
     */
    public function indexAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $searchTerm = $request->get('search_input');
            $artigosPublicados = $this->searchService->getAllArtigosPublicadosByKeyword($searchTerm);

            var_dump($artigosPublicados);
            die();
        }
        return $this->render('search/search.html.twig');
    }
}
