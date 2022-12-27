<?php

declare(strict_types=1);

namespace Termyn\DateTime;

use DateTimeInterface as DateTime;
use Stringable;

interface TimeUnit extends Stringable
{
    public static function fromDateTime(DateTime $dateTime): self;
}
