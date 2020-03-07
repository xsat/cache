<?php

declare(strict_types=1);

namespace Cache;

/**
 * Interface CacheInterface
 */
interface CacheInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key): ?string;

    /**
     * @param string $key
     * @param string|null $value
     * @param int $ttl Time to live
     */
    public function set(string $key, ?string $value, int $ttl = 3600): void;
}
