<?php

declare(strict_types=1);

namespace Cache;

/**
 * Class ConsistentCache
 */
class ConsistentCache implements CacheInterface
{
    /**
     * @var CacheInterface[]
     */
    private array $caches = [];

    /**
     * ConsistentCache constructor.
     *
     * @param CacheInterface[] $caches
     */
    public function __construct(array $caches)
    {
        $this->caches = $caches;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key): ?string
    {
        foreach ($this->caches as $cache) {
            $value = $cache->get($key);

            if ($value !== null) {
                return $value;
            }
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, ?string $value, int $ttl = 3600): void
    {
        foreach ($this->caches as $cache) {
            $cache->set($key, $value, $ttl);
        }
    }
}
