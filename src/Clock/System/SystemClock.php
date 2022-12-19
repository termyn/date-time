<?php

declare(strict_types=1);

namespace Termyn\Clock\System;

use Termyn\Clock;
use Termyn\Instant;

final class SystemClock implements Clock
{
    public function measure(): Instant
    {
        return Instant::of(time());
    }
}
