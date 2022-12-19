<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final class Day implements TimeUnit
{
    use Comparable;

    public const HOURS_IN_DAY = 24;

    public const MINUTES_IN_DAY = 1440;

    public const MINUTES_IN_HOUR = 60;

    public const SECONDS_IN_DAY = 86400;

    public function __construct(
        private readonly int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 1,
            max: 31,
            message: 'The day of the month is out of the range (from %2$s to %3$s), "%s" given.',
        );
    }

    public function __toString(): string
    {
        return sprintf('%02d', $this->value);
    }

    public static function fromDateTime(
        DateTime $dateTime
    ): self {
        return new self(
            intval($dateTime->format('d'))
        );
    }

    protected function comparator(): Closure
    {
        return fn (Day $that): int => $this->value <=> $that->value;
    }
}
