<?php

declare(strict_types=1);

namespace Termyn\DateTime\Clock\System;

use Termyn\DateTime\Clock\AdjustableClock;
use Termyn\DateTime\Clock\PresetClock;
use Termyn\DateTime\Instant;
use Termyn\DateTime\TimePeriod\Days;
use Termyn\DateTime\TimePeriod\Hours;
use Termyn\DateTime\TimePeriod\Minutes;
use Termyn\DateTime\TimePeriod\Seconds;

final readonly class SystemAdjustableClock implements AdjustableClock
{
    public function __construct(
        private SystemClock $systemClock,
    ) {

    }

    public function measure(): Instant
    {
        return $this->systemClock->measure();
    }

    public function moveClockwise(Hours|Days|Minutes|Seconds $by): PresetClock
    {
        return PresetClock::set(
            instant: $this->measure(),
            shift: $by->absolute(),
        );
    }

    public function moveCounterClockwise(Hours|Days|Minutes|Seconds $by): PresetClock
    {
        return PresetClock::set(
            instant: $this->measure(),
            shift: $by->negated(),
        );
    }
}
