<?php

namespace AppBundle\Service;

use AppBundle\Domain\SearchResult;
use AppBundle\Search\VoteEventFilter;
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

    /**
     * @param string          $query
     * @param VoteEventFilter $filter
     * @return array
     */
    public function search($query = '', VoteEventFilter $filter)
    {
        $response = $this->client->request('POST', '/v0/utrecht/vote_events/search', [
            'json' => [
                'query'  => $query,
                'filters' => $filter->toFilterArray()
            ]
        ]);

        $searchResult = [];

        $results = json_decode($response->getBody()->getContents(), true);
        $searchResult['total'] = isset($results['meta']['total'])  ? $results['meta']['total'] : null;
        $results = isset($results['vote_events']) ? $results['vote_events'] : [];
        $results = $this->serializeResults($results);

        $searchResult['results'] = $results;

        return $searchResult;
    }

    /**
     * @param array $results
     * @return array
     */
    private function serializeResults(array $results)
    {
        $resultArray = [];

        foreach ($results as $result) {
            $resultArray[] = SearchResult::fromArray($result);
        }

        return $resultArray;
    }
}