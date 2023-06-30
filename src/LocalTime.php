<?php

declare(strict_types=1);

namespace Termyn\DateTime;

use DateTimeImmutable;
use DateTimeInterface as DateTime;
use Stringable;
use Termyn\DateTime\TimeUnit\Hour;
use Termyn\DateTime\TimeUnit\Minute;
use Termyn\DateTime\TimeUnit\Second;

final readonly class LocalTime implements Stringable
{
    public function __construct(
        public Hour $hour,
        public Minute $minute,
        public Second $second,
    ) {
    }

    public function __toString(): string
    {
        return vsprintf('%s:%s:%s', [
            $this->hour,
            $this->minute,
            $this->second,
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
            new DateTimeImmutable(sprintf('@%s', $instant->epochSeconds->value))
        );
    }

    public static function fromDateTime(
        DateTime $dateTime
    ): self {
        return new self(
            Hour::fromDateTime($dateTime),
            Minute::fromDateTime($dateTime),
            Second::fromDateTime($dateTime)
        );
    }

    public function equals(self $that): bool
    {
        return $this->hour->equals($that->hour)
            && $this->minute->equals($that->minute)
            && $this->second->equals($that->second);
    }

    public function isLaterThan(self $that): bool
    {
        return match (true) {
            $this->hour->isLaterThan($that->hour) => true,
            $this->hour->isLaterThanOrEqualTo($that->hour) && $this->minute->isLaterThan($that->minute) => true,
            $this->hour->isLaterThanOrEqualTo($that->hour) && $this->minute->isLaterThanOrEqualTo($that->minute) && $this->second->isLaterThan($that->second) => true,
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
            $this->hour->isEarlierThan($that->hour) => true,
            $this->hour->isEarlierThanOrEqualTo($that->hour) && $this->minute->isEarlierThan($that->minute) => true,
            $this->hour->isEarlierThanOrEqualTo($that->hour) && $this->minute->isEarlierThanOrEqualTo($that->minute) && $this->second->isEarlierThan($that->second) => true,
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
