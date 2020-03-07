<?php

declare(strict_types=1);

namespace Cache;

use Cache\Model\Element;
use InvalidArgumentException;

/**
 * Class FileCache
 */
class FileCache implements CacheInterface
{
    /**
     * @var string
     */
    private string $storage;

    /**
     * FileCache constructor.
     *
     * @param string $storage
     *
     * @throws InvalidArgumentException then storage is not directory
     */
    public function __construct(string $storage)
    {
        $this->storage = realpath($storage);

        if (!is_dir($this->storage)) {
            throw new InvalidArgumentException('Storage is not directory');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key): ?string
    {
        $file = $this->getFile($key);

        if (!file_exists($file)) {
            return null;
        }

        $data = json_decode(file_get_contents($file), true) ?: [];
        $element = new Element();
        $element->setValue($data['value'] ?? null);
        $element->setExpiredAt($data['expiredAt'] ?? 0);

        if ($element->getValue() === null) {
            unlink($file);
        }

        return $element->getValue();
    }

    /**
     * {@inheritDoc}
     */
    public function set(string $key, ?string $value, int $ttl = 3600): void
    {
        $element = new Element();
        $element->setValue($value);
        $element->setExpiredAt(time() + $ttl);

        file_put_contents(
            $this->getFile($key),
            json_encode($element, JSON_PRETTY_PRINT)
        );
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function getFile(string $key): string
    {
        return $this->storage . DIRECTORY_SEPARATOR . "$key.json";
    }
}
