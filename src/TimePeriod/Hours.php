<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimePeriod;

use Termyn\DateTime\TimePeriod;
use Termyn\DateTime\TimeUnit\Day;
use Termyn\DateTime\TimeUnit\Hour;

final readonly class Hours extends TimePeriod
{
    public static function fromDays(Days $days): self
    {
        return new self($days->value * Day::HOURS_IN_DAY);
    }

    public static function fromMinutes(Minutes $minutes): self
    {
        return new self(
            intdiv($minutes->value, Hour::MINUTES_IN_HOUR)
        );
    }

    public static function fromSeconds(Seconds $seconds): self
    {
        return new self(
            intdiv($seconds->value, Hour::SECONDS_IN_HOUR)
        );
    }

    public function inDays(): Days
    {
        return Days::fromHours($this);
    }

    public function inHours(): self
    {
        return $this;
    }

    public function inMinutes(): Minutes
    {
        return Minutes::fromHours($this);
    }

    public function inSeconds(): Seconds
    {
        return Seconds::fromHours($this);
    }
}
