<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use LogicException;

class Deck
{
    /**
     * @param array<Card> $cards
     */
    public function __construct(
        private array $cards = [],
        private int $initNumberOfCards = 0,
    ) {
    }

    /**
     * @return array<Card>
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function init(int $numberOfCards): Deck
    {
        $this->initNumberOfCards =$numberOfCards;

        for ($i=0; $i < $this->initNumberOfCards; $i++) {
            $card = new Card($i+1);
            $this->addACard($card);
        }
        return $this;
    }

    public function getInitNumberOfCards(): int
    {
        return $this->initNumberOfCards;
    }

    public function addACard(Card $card): void
    {
        $this->cards[] = $card;
    }


    /**
     * @throw LogicException
     */
    public function drawTheTopCard(): Card
    {
        if (!empty($this->cards)) {
            return array_pop($this->cards);
        }
        throw new LogicException("Cannot draw a card on an empty deck", 1);
    }

    public function mixTheCards(): void
    {
        shuffle($this->cards);
    }

    public function isEmpty(): bool
    {
        return empty($this->cards);
    }
}
