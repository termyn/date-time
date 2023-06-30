<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final readonly class Year implements TimeUnit
{
    use Comparable;

    public const MONTHS_PER_YEAR = 12;

    public const WEEKS_PER_YEAR = 53;

    public function __construct(
        private int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 1000,
            max: 2999,
            message: 'The year is out of the range (from %2$s to %3$s), "%s" given.'
        );
    }

    public function __toString(): string
    {
        return sprintf('%04d', $this->value);
    }

    public static function fromDateTime(
        DateTime $dateTime
    ): self {
        return new self(
            intval($dateTime->format('o'))
        );
    }

    public function isLeap(): bool
    {
        return ($this->value & 3) === 0
            && (($this->value % 100) !== 0 || ($this->value % 400) === 0);
    }

    protected function comparator(): Closure
    {
        return fn (Year $that): int => $this->value <=> $that->value;
    }
}
