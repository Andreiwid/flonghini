<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/busca", name="busca")
     */
    public function indexAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $searchTerm = $request->get('search_input');
            var_dump($searchTerm);
            die();
        }
        return $this->render('search/search.html.twig');
    }
}
