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
     * SearchResult constructor.
     * @param string $id
     * @param string $result
     * @param string $classification
     * @param string $description
     */
    public function __construct($id, $result, $classification, $description)
    {
        $this->id = $id;
        $this->result = $result;
        $this->classification = $classification;
        $this->description = $description;
    }

    public static function fromArray(array $result)
    {
        return new static(
            $result['id'],
            $result['result'],
            $result['classification'],
            isset($result['motion']['legislative_session']['description']) ? $result['motion']['legislative_session']['description'] : ''
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
}