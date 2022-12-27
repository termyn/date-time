<?php

declare(strict_types=1);

namespace Termyn\DateTime;

interface Clock
{
    public function measure(): Instant;
}
