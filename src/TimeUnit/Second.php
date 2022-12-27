<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final class Second implements TimeUnit
{
    use Comparable;

    public function __construct(
        private readonly int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 0,
            max: Minute::SECONDS_IN_MINUTE - 1,
            message: 'The second of the minute is out of the range (from %2$s to %3$s), "%s" given.',
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
            intval($dateTime->format('s'))
        );
    }

    protected function comparator(): Closure
    {
        return fn (Second $that): int => $this->value <=> $that->value;
    }
}
