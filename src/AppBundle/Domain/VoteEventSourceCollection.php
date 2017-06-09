<?php

namespace AppBundle\Domain;

class VoteEventSourceCollection
{
    /**
     * @var string
     */
    private $note;

    /**
     * @var string
     */
    private $url;

    /**
     * VoteEventSourceCollection constructor.
     * @param string $note
     * @param string $url
     */
    public function __construct($note, $url)
    {
        $this->note = $note;
        $this->url = $url;
    }

    /**
     * @param array $source
     * @return static
     */
    public static function fromArray(array $source)
    {
        return new static(
            $source['note'],
            $source['url']
        );
    }
}