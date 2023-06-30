<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final readonly class Minute implements TimeUnit
{
    use Comparable;

    public const SECONDS_IN_MINUTE = 60;

    public function __construct(
        private int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 0,
            max: Hour::MINUTES_IN_HOUR - 1,
            message: 'The minute of the hour is out of the range (from %2$s to %3$s), "%s" given.',
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
            intval($dateTime->format('i'))
        );
    }

    protected function comparator(): Closure
    {
        return fn (Minute $that): int => $this->value <=> $that->value;
    }
}
