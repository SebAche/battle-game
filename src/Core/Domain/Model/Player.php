<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use App\Core\Domain\Model\Deck;

class Player
{
    public function __construct(
        private string $name,
        private Deck $deck = new Deck(),
        private int $cummulatedPoints = 0,
    ) {
        $this->name = $this->formatName($name);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function receiveACard(Card $card): void
    {
        $this->deck->addACard($card);
    }

    public function playACard(): ?Card
    {
        return $this->deck->drawTheTopCard();
    }

    public function addOnePoint()
    {
        $this->cummulatedPoints++;
    }

    public function getTheCummulatedPoints(): int
    {
        return $this->cummulatedPoints;
    }

    public function getCards(): Deck
    {
        return $this->deck;
    }

    private function formatName(string $name): string
    {
        return ucfirst(trim($name));
    }
}
