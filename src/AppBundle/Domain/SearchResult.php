<?php

namespace AppBundle\Domain;

use Shudrum\Component\ArrayFinder\ArrayFinder;
use Symfony\Component\Validator\Constraints\DateTime;

class SearchResult
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $date;

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
     * @param string $id
     * @param string $date
     * @param string $result
     * @param string $classification
     * @param string $description
     * @param array  $sources
     */
    public function __construct($id, $date, $result, $classification, $description, array $sources)
    {
        $this->id = $id;
        $this->date = $date;
        $this->result = $result;
        $this->classification = $classification;
        $this->description = $description;
        $this->sources = $sources;
    }

    public static function fromArray(array $result)
    {
        $sources = [];
        foreach ($result['sources'] as $source) {
            $sources[] = VoteEventSource::fromArray($source);
        }

        foreach($result['motion']['legislative_session']['sources'] as $source) {
            $sources[] = VoteEventSource::fromArray($source);
        }

        return new static(
            $result['id'],
            $result['end_date'],
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
    public function getDate()
    {
        return $this->date;
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