<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final class Hour implements TimeUnit
{
    use Comparable;

    public const MINUTES_IN_HOUR = 60;

    public const SECONDS_IN_HOUR = 3600;

    public function __construct(
        private readonly int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 0,
            max: Day::HOURS_IN_DAY - 1,
            message: 'The hour of the day is out of the range (from %2$s to %3$s), "%s" given.',
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
            intval($dateTime->format('H'))
        );
    }

    protected function comparator(): Closure
    {
        return fn (Hour $that): int => $this->value <=> $that->value;
    }
}
