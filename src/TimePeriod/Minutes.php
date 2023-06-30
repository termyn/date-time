<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimePeriod;

use Termyn\DateTime\TimePeriod;
use Termyn\DateTime\TimeUnit\Day;
use Termyn\DateTime\TimeUnit\Hour;
use Termyn\DateTime\TimeUnit\Minute;

final readonly class Minutes extends TimePeriod
{
    public static function fromDays(Days $days): self
    {
        return new self($days->value * Day::MINUTES_IN_DAY);
    }

    public static function fromHours(Hours $hours): self
    {
        return new self($hours->value * Hour::MINUTES_IN_HOUR);
    }

    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(
            intdiv($seconds->value, Minute::SECONDS_IN_MINUTE)
        );
    }

    public function inDays(): Days
    {
        return Days::fromMinutes($this);
    }

    public function inHours(): Hours
    {
        return Hours::fromMinutes($this);
    }

    public function inMinutes(): self
    {
        return $this;
    }

    public function inSeconds(): Seconds
    {
        return Seconds::fromMinutes($this);
    }
}
