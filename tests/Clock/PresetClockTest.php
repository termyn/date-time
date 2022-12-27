<?php

declare(strict_types=1);

namespace Termyn\DateTime\Test\Clock;

use PHPUnit\Framework\TestCase;
use Termyn\DateTime\Clock\PresetClock;
use Termyn\DateTime\Instant;

final class PresetClockTest extends TestCase
{
    private const TIMESTAMP = 1652974976;

    public function testItMeasuresTime(): void
    {
        $clock = new PresetClock(
            Instant::of(self::TIMESTAMP)
        );

        $instant = $clock->measure();

        $this->assertSame(self::TIMESTAMP, $instant->epochSeconds->value);
    }
}
