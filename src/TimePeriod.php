<?php

declare(strict_types=1);

namespace Termyn\DateTime;

abstract class TimePeriod
{
    final public function __construct(
        public readonly int $value
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
}
