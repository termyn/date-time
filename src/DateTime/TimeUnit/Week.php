<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final class Week implements TimeUnit
{
    use Comparable;

    public const DAYS_PER_WEEK = 7;

    public function __construct(
        private readonly int $value,
    ) {
        Assert::range(
            value: $this->value,
            min: 1,
            max: Year::WEEKS_PER_YEAR,
            message: 'The week of the year is out of the range (from %2$s to %3$s), "%s" given.'
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
            intval($dateTime->format('W'))
        );
    }

    protected function comparator(): Closure
    {
        return fn (Week $that): int => $this->value <=> $that->value;
    }
}
