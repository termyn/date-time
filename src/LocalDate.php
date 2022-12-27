<?php

declare(strict_types=1);

namespace Termyn\DateTime;

use DateTimeImmutable;
use DateTimeInterface as DateTime;
use Stringable;
use Termyn\DateTime\TimeUnit\Day;
use Termyn\DateTime\TimeUnit\Month;
use Termyn\DateTime\TimeUnit\Year;

final class LocalDate implements Stringable
{
    public function __construct(
        public readonly Year $year,
        public readonly Month $month,
        public readonly Day $day,
    ) {
    }

    public function __toString(): string
    {
        return vsprintf('%s-%s-%s', [
            $this->year,
            $this->month,
            $this->day,
        ]);
    }

    public static function byClock(Clock $clock): self
    {
        return self::sinceInstant(
            $clock->measure()
        );
    }

    public static function sinceInstant(Instant $instant): self
    {
        return self::fromDateTime(
            new DateTimeImmutable(
                sprintf('@%s', $instant->epochSeconds->value)
            )
        );
    }

    public static function fromDateTime(
        DateTime $dateTime
    ): self {
        return new self(
            Year::fromDateTime($dateTime),
            Month::fromDateTime($dateTime),
            Day::fromDateTime($dateTime),
        );
    }

    public function equals(self $that): bool
    {
        return $this->year->equals($that->year)
            && $this->month->equals($that->month)
            && $this->day->equals($that->day);
    }

    public function isLaterThan(self $that): bool
    {
        return match (true) {
            $this->year->isLaterThan($that->year) => true,
            $this->year->isLaterThanOrEqualTo($that->year) && $this->month->isLaterThan($that->month) => true,
            $this->year->isLaterThanOrEqualTo($that->year) && $this->month->isLaterThanOrEqualTo($that->month) && $this->day->isLaterThan($that->day) => true,
            default => false,
        };
    }

    public function isLaterThanOrEqualTo(self $that): bool
    {
        return $this->equals($that) || $this->isLaterThan($that);
    }

    public function isEarlierThan(self $that): bool
    {
        return match (true) {
            $this->year->isEarlierThan($that->year) => true,
            $this->year->isEarlierThanOrEqualTo($that->year) && $this->month->isEarlierThan($that->month) => true,
            $this->year->isEarlierThanOrEqualTo($that->year) && $this->month->isEarlierThanOrEqualTo($that->month) && $this->day->isEarlierThan($that->day) => true,
            default => false,
        };
    }

    public function isEarlierThanOrEqualTo(self $that): bool
    {
        return $this->equals($that) || $this->isEarlierThan($that);
    }

    public function isBetweenInclusive(self $from, self $to): bool
    {
        return $this->isLaterThanOrEqualTo($from) && $this->isEarlierThanOrEqualTo($to);
    }

    public function isBetweenExclusive(self $from, self $to): bool
    {
        return $this->isLaterThan($from) && $this->isEarlierThan($to);
    }
}
