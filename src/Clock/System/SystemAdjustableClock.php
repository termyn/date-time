<?php

declare(strict_types=1);

namespace Termyn\Clock\System;

use Termyn\Clock\AdjustableClock;
use Termyn\Clock\PresetClock;
use Termyn\DateTime\TimePeriod\Days;
use Termyn\DateTime\TimePeriod\Hours;
use Termyn\DateTime\TimePeriod\Minutes;
use Termyn\DateTime\TimePeriod\Seconds;
use Termyn\Instant;

final class SystemAdjustableClock implements AdjustableClock
{
    public function __construct(
        private readonly SystemClock $systemClock,
    ) {

    }

    public function measure(): Instant
    {
        return $this->systemClock->measure();
    }

    public function moveClockwise(
        Hours|Days|Minutes|Seconds $by,
    ): PresetClock {
        return PresetClock::set(
            instant: $this->measure(),
            shift: $by->absolute(),
        );
    }

    public function moveCounterClockwise(
        Hours|Days|Minutes|Seconds $by,
    ): PresetClock {
        return PresetClock::set(
            instant: $this->measure(),
            shift: $by->negated(),
        );
    }
}
