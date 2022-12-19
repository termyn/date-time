<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimePeriod;

use Termyn\DateTime\TimePeriod;
use Termyn\DateTime\TimeUnit\Day;

final class Days extends TimePeriod
{
    public static function fromHours(
        Hours $hours
    ): self {
        return new self(
            intdiv($hours->value, Day::HOURS_IN_DAY)
        );
    }

    public static function fromMinutes(
        Minutes $minutes
    ): self {
        return new self(
            intdiv($minutes->value, Day::MINUTES_IN_DAY)
        );
    }

    public static function fromSeconds(
        Seconds $seconds
    ): self {
        return new self(
            intdiv($seconds->value, Day::SECONDS_IN_DAY)
        );
    }

    public function hours(): Hours
    {
        return Hours::fromDays($this);
    }

    public function minutes(): Minutes
    {
        return Minutes::fromDays($this);
    }

    public function seconds(): Seconds
    {
        return Seconds::fromDays($this);
    }
}
