<?php

namespace AppBundle\Domain;

use Shudrum\Component\ArrayFinder\ArrayFinder;

class SearchResult
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $result;

    /**
     * @var string
     */
    private $classification;

    /**
     * @var string
     */
    private $description;

    /**
     * @var VoteEventSourceCollection
     */
    private $sources;

    /**
     * SearchResult constructor.
     * @param string                    $id
     * @param string                    $result
     * @param string                    $classification
     * @param string                    $description
     * @param VoteEventSourceCollection $sources
     */
    public function __construct($id, $result, $classification, $description, VoteEventSourceCollection $sources)
    {
        $this->id = $id;
        $this->result = $result;
        $this->classification = $classification;
        $this->description = $description;
        $this->sources = $sources
    }

    public static function fromArray(array $result)
    {
        $sources = [];
        foreach ($result['sources'] as $source) {
            $sources[] = VoteEventSourceCollection::fromArray($source);
        }

        return new static(
            $result['id'],
            $result['result'],
            $result['classification'],
            isset($result['motion']['legislative_session']['description']) ? $result['motion']['legislative_session']['description'] : '',
            $sources
        );
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return VoteEventSourceCollection
     */
    public function getSources()
    {
        return $this->sources;
    }
}