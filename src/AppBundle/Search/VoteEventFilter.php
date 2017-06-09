<?php

namespace AppBundle\Search;

use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VoteEventFilter
 * @package AppBundle\Search
 */
class VoteEventFilter
{
    /**
     * @JMS\Type("string")
     *
     * @var string
     */
    private $startDateFrom;

    /**
     * @JMS\Type("string")
     *
     * @var string
     */
    private $startDateTo;

    /**
     * @return array
     */
    public function toFilterArray()
    {
        return [
            'start_date' => [
                'from' => $this->startDateFrom,
                'to' => $this->startDateTo,
            ]
        ];
    }
}