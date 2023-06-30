<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimePeriod;

use Termyn\DateTime\TimePeriod;
use Termyn\DateTime\TimeUnit\Day;
use Termyn\DateTime\TimeUnit\Hour;
use Termyn\DateTime\TimeUnit\Minute;

final readonly class Seconds extends TimePeriod
{
    public static function fromDays(Days $days): self
    {
        return new self($days->value * Day::SECONDS_IN_DAY);
    }

    public static function fromHours(Hours $hours): self
    {
        return new self($hours->value * Hour::SECONDS_IN_HOUR);
    }

    public static function fromMinutes(Minutes $minutes): self
    {
        return new self($minutes->value * Minute::SECONDS_IN_MINUTE);
    }

    public function increase(self $seconds): self
    {
        return new self($this->value + $seconds->value);
    }

    public function decrease(self $seconds): self
    {
        return new self($this->value - $seconds->value);
    }
}
