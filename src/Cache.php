<?php

declare(strict_types=1);

namespace Cache;

use InvalidArgumentException;

/**
 * Class Cache
 */
class Cache implements CacheInterface
{
    /**
     * Allowed types
     */
    public const TYPE_STATIC = 'static';
    public const TYPE_FILE = 'file';

    /**
     * @var CacheInterface[]
     */
    private CacheInterface $innerCache;

    /**
     * Cache constructor.
     *
     * @param string $storage
     * @param array $sequenceTypes
     *
     * @throws InvalidArgumentException then storage is not directory
     * @throws InvalidArgumentException then type is not supported
     */
    public function __construct(
        string $storage,
        array $sequenceTypes = [
            self::TYPE_STATIC,
            self::TYPE_FILE,
        ]
    ) {
        $caches = [];

        foreach ($sequenceTypes as $type) {
            if ($type === self::TYPE_STATIC) {
                $caches[] = new StaticCache();
            } elseif ($type === self::TYPE_FILE) {
                $caches[] = new FileCache($storage);
            } else {
                throw new InvalidArgumentException("`$type` is not supported");
            }
        }

        $this->innerCache = new ConsistentCache($caches);
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key): ?string
    {
        return $this->innerCache->get($key);
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, ?string $value, int $ttl = 3600): void
    {
        $this->innerCache->set($key, $value, $ttl);
    }
}
