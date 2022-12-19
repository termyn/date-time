<?php

declare(strict_types=1);

namespace Termyn\Clock;

use Termyn\Clock;
use Termyn\DateTime\TimePeriod\Days;
use Termyn\DateTime\TimePeriod\Hours;
use Termyn\DateTime\TimePeriod\Minutes;
use Termyn\DateTime\TimePeriod\Seconds;

interface AdjustableClock extends Clock
{
    public function moveClockwise(
        Days|Hours|Minutes|Seconds $by,
    ): PresetClock;

    public function moveCounterClockwise(
        Days|Hours|Minutes|Seconds $by,
    ): PresetClock;
}
