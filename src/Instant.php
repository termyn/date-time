<?php

declare(strict_types=1);

namespace Termyn\DateTime;

use Stringable;
use Termyn\DateTime\TimePeriod\Seconds;

final class Instant implements Stringable
{
    public function __construct(
        public readonly Seconds $epochSeconds
    ) {
    }

    public static function of(
        int $epochSeconds,
    ): self {
        return new self(
            new Seconds($epochSeconds)
        );
    }

    public function equals(self $that): bool
    {
        return $this->epochSeconds->equals($that->epochSeconds);
    }

//    public function compare(self $that): int
//    {
//        return $this->epochSeconds->compare($that->epochSeconds);
//    }

    public function shift(Seconds $seconds): self
    {
        return new self(
            $this->epochSeconds->increase($seconds)
        );
    }

    public function delta(self $that): Seconds
    {
        return $this->epochSeconds->decrease(
            $that->epochSeconds->absolute()
        );
    }

    public function __toString(): string
    {
        return sprintf('%s', $this->epochSeconds->value);
    }
}
