<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;
use DateTimeInterface as DateTime;
use Termyn\DateTime\TimeUnit;
use Webmozart\Assert\Assert;

final readonly class Month implements TimeUnit
{
    use Comparable;

    public const JANUARY = 1;

    public const FEBRUARY = 2;

    public const MARCH = 3;

    public const APRIL = 4;

    public const MAY = 5;

    public const JUNE = 6;

    public const JULY = 7;

    public const AUGUST = 8;

    public const SEPTEMBER = 9;

    public const OCTOBER = 10;

    public const NOVEMBER = 11;

    public const DECEMBER = 12;

    public function __construct(
        private int $value
    ) {
        Assert::range(
            value: $this->value,
            min: 1,
            max: Year::MONTHS_PER_YEAR,
            message: 'The month of the year is out of the range (from %2$s to %3$s), "%s" given.'
        );
    }

    public function __toString(): string
    {
        return sprintf('%02d', $this->value);
    }

    public static function fromDateTime(DateTime $dateTime): self
    {
        return new self(
            intval($dateTime->format('n'))
        );
    }

    public function name(): string
    {
        $names = [
            self::JANUARY => 'January',
            self::FEBRUARY => 'February',
            self::MARCH => 'March',
            self::APRIL => 'April',
            self::MAY => 'May',
            self::JUNE => 'June',
            self::JULY => 'July',
            self::AUGUST => 'August',
            self::SEPTEMBER => 'September',
            self::OCTOBER => 'October',
            self::NOVEMBER => 'November',
            self::DECEMBER => 'December',
        ];

        return $names[$this->value];
    }

    protected function comparator(): Closure
    {
        return fn (Month $that): int => $this->value <=> $that->value;
    }
}
