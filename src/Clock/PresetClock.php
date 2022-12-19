<?php

declare(strict_types=1);

namespace Termyn\Clock;

use Termyn\Clock;
use Termyn\DateTime\TimePeriod\Days;
use Termyn\DateTime\TimePeriod\Hours;
use Termyn\DateTime\TimePeriod\Minutes;
use Termyn\DateTime\TimePeriod\Seconds;
use Termyn\Instant;

final class PresetClock implements Clock
{
    public function __construct(
        private readonly Instant $instant
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
