<?php

declare(strict_types=1);

namespace Termyn\DateTime\Clock;

use Termyn\DateTime\Clock;
use Termyn\DateTime\Instant;

final readonly class PresetClock implements Clock
{
    public function __construct(
        private Instant $instant
    ) {
    }

    public static function setBy(Clock $clock): self
    {
        return new self($clock->measure());
    }

    public function measure(): Instant
    {
        return $this->instant;
    }
}
