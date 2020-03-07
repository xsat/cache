<?php

declare(strict_types=1);

namespace Cache\Model;

use JsonSerializable;

/**
 * Class Element
 */
class Element implements JsonSerializable
{
    /**
     * @var string|null
     */
    private ?string $value = null;

    /**
     * @var int
     */
    private int $expiredAt = 0;

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        if (time() >= $this->expiredAt) {
            return null;
        }

        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }

    /**
     * @param int $expiredAt
     */
    public function setExpiredAt(int $expiredAt): void
    {
        $this->expiredAt = $expiredAt;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value,
            'expiredAt' => $this->expiredAt,
        ];
    }
}
