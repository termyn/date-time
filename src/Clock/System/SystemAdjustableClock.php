<?php

declare(strict_types=1);

namespace Termyn\DateTime\Clock\System;

use Termyn\DateTime\Clock\AdjustableClock;
use Termyn\DateTime\Clock\PresetClock;
use Termyn\DateTime\Instant;
use Termyn\DateTime\TimePeriod;

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

    public function moveClockwise(TimePeriod $by): PresetClock
    {
        return new PresetClock(
            $this->measure()->shift($by->inSeconds())
        );
    }

    public function moveCounterClockwise(TimePeriod $by): PresetClock
    {
        return new PresetClock(
            $this->measure()->shift($by->inSeconds()->negated())
        );
    }
}
