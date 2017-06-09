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
     * SearchResult constructor.
     * @param string $id
     * @param string $result
     * @param string $classification
     */
    public function __construct($id, $result, $classification)
    {
        $this->id = $id;
        $this->result = $result;
        $this->classification = $classification;
    }

    public static function fromArray(array $result)
    {
        return new static(
            $result['id'],
            $result['result'],
            $result['classification']
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