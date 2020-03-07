<?php

declare(strict_types=1);

namespace Cache;

use Cache\Model\Element;

/**
 * Class StaticCache
 */
class StaticCache implements CacheInterface
{
    /**
     * @var Element[]
     */
    private static array $elements = [];

    /**
     * {@inheritDoc}
     */
    public function get(string $key): ?string
    {
        if (!isset(self::$elements[$key])) {
            return null;
        }

        $value = self::$elements[$key]->getValue();

        if ($value === null) {
            unset(self::$elements[$key]);
        }

        return $value;
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, ?string $value, int $ttl = 3600): void
    {
        if (!isset(self::$elements[$key])) {
            self::$elements[$key] = new Element();
        }

        self::$elements[$key]->setValue($value);
        self::$elements[$key]->setExpiredAt(time() + $ttl);
    }
}
