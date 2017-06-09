<?php

namespace AppBundle\Controller;

use AppBundle\Search\VoteEventFilter;
use AppBundle\Service\Searcher;
use JMS\Serializer\Serializer;
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
        /** @var Serializer $serializer */
        $serializer = $this->get('jms_serializer');

        $searcher = $this->get(Searcher::class);

        $filter = $request->get('filter');
        $filter = $serializer->deserialize(
            json_encode($request->get('filter')),
            VoteEventFilter::class,
            'json'
        );

        $results = $searcher->search($request->get('query'), $filter);

        return $this->render('default/index.html.twig',
            [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'results' => $results['results'],
                'total' => $results['total']
            ]
        );
    }
}
