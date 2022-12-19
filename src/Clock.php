<?php

declare(strict_types=1);

namespace Termyn;

interface Clock
{
    public function measure(): Instant;
}
