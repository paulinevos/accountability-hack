<?php

namespace AppBundle\Domain;

use MyCLabs\Enum\Enum;

/**
 * Class VoteResult
 * @package AppBundle\Domain
 *
 * @method static VoteResult ACCEPTED()
 * @method static VoteResult DENIED()
 * @method static VoteResult WITHDRAWN()
 * @method static VoteResult WITHDRAWN_TRANSFERRED()
 */
class VoteResult extends Enum
{
    const ACCEPTED              = 'motie-aangenomen';
    const DENIED                = 'motie-afgewezen';
    const WITHDRAWN             = 'motie-ingetrokken';
    const WITHDRAWN_TRANSFERRED = 'motie-ingetrokken-overgenomen';

    const HUMAN_VALUES = [
        self::ACCEPTED              => 'Motie aangenomen',
        self::DENIED                => 'Motie afgewezen',
        self::WITHDRAWN             => 'Motie ingetrokken',
        self::WITHDRAWN_TRANSFERRED => 'Motie ingetrokken en overgenomen',
    ];

    /**
     * @return string
     */
    public function toHuman()
    {
        return self::HUMAN_VALUES[$this->getValue()];
    }

    /**
     * @param string $value
     * @return string
     */
    public function fromHuman($value)
    {
        $humanFlip = array_flip(self::HUMAN_VALUES);

        return $humanFlip[$value];
    }
}