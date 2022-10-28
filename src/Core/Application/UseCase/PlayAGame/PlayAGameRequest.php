<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\PlayAGame;

class PlayAGameRequest
{


    public function __construct(
        private string $namePlayerOne,
        private string $namePlayerTwo,
        private int $numberOfCards,
        private bool $battleDisplayed = false,
    )
    {}

    public function getPlayerOneName(): string
    {
        return $this->formatName($this->namePlayerOne);
    }

    public function getPlayerTwoName() :string
    {
        return $this->formatName($this->namePlayerTwo);
    }

    public function getNumberOfCards(): int
    {
        return $this->numberOfCards;
    }

    public function isBattleDisplayed(): bool
    {
        return $this->battleDisplayed;
    }

    private function formatName(string $name): string
    {
        return trim($name);
    }

}