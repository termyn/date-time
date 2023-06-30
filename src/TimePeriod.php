<?php

declare(strict_types=1);

namespace Termyn\DateTime;

use Termyn\DateTime\TimePeriod\Days;
use Termyn\DateTime\TimePeriod\Hours;
use Termyn\DateTime\TimePeriod\Minutes;
use Termyn\DateTime\TimePeriod\Seconds;

abstract readonly class TimePeriod
{
    final public function __construct(
        public int $value
    ) {
    }

    public function equals(self $that): bool
    {
        return $this::class === $that::class && $that->value === $this->value;
    }

    public function compare(self $that): int
    {
        return $this->absolute()->value <=> $that->absolute()->value;
    }

    public function isPositive(): bool
    {
        return $this->value >= 0;
    }

    public function isNegative(): bool
    {
        return $this->value < 0;
    }

    public function negated(): static
    {
        return new static((int) -abs($this->value));
    }

    public function absolute(): static
    {
        return new static((int) abs($this->value));
    }

    abstract public function inDays(): Days;

    abstract public function inHours(): Hours;

    abstract public function inMinutes(): Minutes;

    abstract public function inSeconds(): Seconds;
}
