<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

final readonly class MonthDay
{
    public function __construct(
        public readonly Day $day,
        public readonly Month $month,
        public readonly Year $year,
    ) {

    }
}
