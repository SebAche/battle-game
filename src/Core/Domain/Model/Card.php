<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

class Card
{
    public function __construct(
        private int $value,
    )
    {}

    public function getValue(): ?int
    {
        return $this->value;
    }
}
