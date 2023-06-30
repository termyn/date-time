<?php

declare(strict_types=1);

namespace Termyn\DateTime\Clock;

use Termyn\DateTime\Clock;
use Termyn\DateTime\Instant;
use Termyn\DateTime\TimePeriod\Days;
use Termyn\DateTime\TimePeriod\Hours;
use Termyn\DateTime\TimePeriod\Minutes;
use Termyn\DateTime\TimePeriod\Seconds;

final readonly class PresetClock implements Clock
{
    public function __construct(
        private Instant $instant
    ) {
    }

    public static function set(
        Instant $instant,
        Days|Hours|Minutes|Seconds $shift
    ): self {
        $shiftInSeconds = ($shift instanceof Seconds) ? $shift : $shift->seconds();

        return new self(
            $instant->shift($shiftInSeconds)
        );
    }

    public function measure(): Instant
    {
        return $this->instant;
    }
}
