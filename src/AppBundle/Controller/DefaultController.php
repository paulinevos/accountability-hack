<?php

namespace AppBundle\Controller;

use AppBundle\Service\Searcher;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Routing;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Routing\Route("/", name="homepage")
     * @Routing\Method("GET")
     *
     * @param Request $request
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Routing\Route("/", name="search-homepage")
     * @Routing\Method("POST")
     *
     * @param Request $request
     */
    public function searchAction(Request $request)
    {
        $searcher = $this->get(Searcher::class);

        $results = $searcher->search();

        return $this->render('default/index.html.twig',
            [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'results' => $results
            ]
        );
    }
}
