<?php

declare(strict_types=1);

namespace Termyn\DateTime\Clock\System;

use Termyn\DateTime\Clock;
use Termyn\DateTime\Instant;

final readonly class SystemClock implements Clock
{
    public function measure(): Instant
    {
        return Instant::of(time());
    }
}
