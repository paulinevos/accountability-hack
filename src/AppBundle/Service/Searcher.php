<?php

namespace AppBundle\Service;

use AppBundle\Domain\SearchResult;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\Serializer;

class Searcher
{
    /**
     * @var \JMS\Serializer\Serializer
     */
    private $serializer;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * Searcher constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client, Serializer $serializer)
    {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function search()
    {
        $response = $this->client->request('GET', '/v0/utrecht/vote_events/search');
        $results = json_decode($response->getBody()->getContents(), true);
        $results = isset($results['vote_events']) ? $results['vote_events'] : [];

        $results = $this->serializeResults($results);

        return $results;
    }

    private function serializeResults(array $results)
    {
        $resultArray = [];
        foreach ($results as $result) {
            $resultArray[] = SearchResult::fromArray($result);
        }

        return $resultArray;
    }
}