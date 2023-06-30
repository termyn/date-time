<?php

declare(strict_types=1);

namespace Termyn\DateTime\Clock;

use Termyn\DateTime\Clock;
use Termyn\DateTime\TimePeriod;

interface AdjustableClock extends Clock
{
    public function moveClockwise(TimePeriod $by): PresetClock;

    public function moveCounterClockwise(TimePeriod $by): PresetClock;
}
