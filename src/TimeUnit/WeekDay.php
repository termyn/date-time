<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final class WeekDay implements TimeUnit
{
    public function __construct(
        private readonly int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 1,
            max: Week::DAYS_PER_WEEK,
            message: 'The day of the week is out of the range (from %2$s to %3$s), "%s" given.'
        );
    }

    public function __toString(): string
    {
        return '';
    }

    public static function fromDateTime(
        DateTime $dateTime
    ): self {
        return new self(
            intval($dateTime->format('N'))
        );
    }
}
