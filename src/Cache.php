<?php

declare(strict_types=1);

namespace Cache;

/**
 * Class Cache
 */
class Cache implements CacheInterface
{
    /**
     * {@inheritDoc}
     */
    public function get(string $key): ?string
    {
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, ?string $value, int $ttl = 3600): void
    {
    }
}
