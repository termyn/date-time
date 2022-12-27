<?php

declare(strict_types=1);

namespace Termyn\DateTime\TimeUnit;

use Closure;

trait Comparable
{
    public function equals(self $that): bool
    {
        return $this->comparator()($that) === 0;
    }

    public function isLaterThan(self $that): bool
    {
        return $this->comparator()($that) > 0;
    }

    public function isLaterThanOrEqualTo(self $that): bool
    {
        return $this->comparator()($that) >= 0;
    }

    public function isEarlierThan(self $that): bool
    {
        return $this->comparator()($that) < 0;
    }

    public function isEarlierThanOrEqualTo(self $that): bool
    {
        return $this->comparator()($that) <= 0;
    }

    public function isBetweenInclusive(self $from, self $to): bool
    {
        return $this->isLaterThanOrEqualTo($from) && $this->isEarlierThanOrEqualTo($to);
    }

    public function isBetweenExclusive(self $from, self $to): bool
    {
        return $this->isLaterThan($from) && $this->isEarlierThan($to);
    }

    abstract protected function comparator(): Closure;
}
