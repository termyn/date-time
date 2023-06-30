<?php

declare(strict_types=1);

namespace Termyn\DateTime;

use DateTimeImmutable;
use DateTimeInterface as DateTime;
use Stringable;

final readonly class LocalDateTime implements Stringable
{
    final public function __construct(
        public LocalDate $date,
        public LocalTime $time,
    ) {
    }

    //    public function modify(Seconds $seconds): self
    //    {
    //        return new static($this->instant->shift($seconds));
    //    }
    //
    //    public function difference(self $that): DateTimeInterval
    //    {
    //        return new DateTimeInterval($this, $that);
    //    }

    public function __toString(): string
    {
        return sprintf('%s %s', $this->date, $this->time);
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
            new DateTimeImmutable(sprintf('@%s', $instant->epochSeconds->value))
        );
    }

    public static function fromDateTime(
        DateTime $dateTime,
    ): self {
        return new self(
            LocalDate::fromDateTime($dateTime),
            LocalTime::fromDateTime($dateTime),
        );
    }

    //    public function fromString(
    //        string $dateTime,
    //        string $dateTimeScheme,
    //    ): self {
    //
    //    }

    public function equals(self $that): bool
    {
        return $this->date->equals($that->date) && $this->time->equals($that->time);
    }

    public function isLaterThan(self $that): bool
    {
        return match (true) {
            $this->date->isLaterThan($that->date) => true,
            $this->date->isLaterThanOrEqualTo($that->date) && $this->time->isLaterThan($that->time) => true,
            default => false,
        };
    }

    public function isLaterThanOrEqualTo(self $that): bool
    {
        return $this->isLaterThan($that) || $this->equals($that);
    }

    public function isEarlierThan(self $that): bool
    {
        return match (true) {
            $this->date->isEarlierThan($that->date) => true,
            $this->date->isEarlierThanOrEqualTo($that->date) && $this->time->isEarlierThan($that->time) => true,
            default => false,
        };
    }

    public function isEarlierThanOrEqualTo(self $that): bool
    {
        return $this->isEarlierThan($that) || $this->equals($that);
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
