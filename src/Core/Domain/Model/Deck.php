<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

class Deck
{
    public function __construct(
        private array $cards = [],
        private int $initNumberOfCards = 0,
    )
    {}

    public function getCards(): array
    {
        return $this->cards;
    }

    public function init(int $numberOfCards): Deck
    {
        $this->initNumberOfCards =$numberOfCards;
        
        for ($i=0; $i < $this->initNumberOfCards; $i++) { 
            $card = New Card($i+1);
            $this->addACard($card);
        }
        return $this;
    }

    public function getInitNumberOfCards(): int
    {
        return $this->initNumberOfCards;
    }

    public function addACard(Card $card):void
    {
        $this->cards[] = $card;       
    }

    public function drawACardAtRandom(): ?Card
    {
        if (empty($this->cards)) {
            return null;
        }
        $randomId = array_rand($this->cards,1);
        return $this->removeACardFromTheDeck($this->cards[$randomId]);
        
    }

    public function drawTheTopCard(): ?Card
    {
        if (empty($this->cards)) {
            return null;
        }
        return  $this->removeACardFromTheDeck(end($this->cards));
    }

    protected function removeACardFromTheDeck(Card $card): ?Card
    {
        $key = array_search($card, $this->cards, true);
        if (false === $key) {
            return null; 
        }
        //prevoir si count 0 return null
        $returnedCard = $this->cards[$key];
        unset($this->cards[$key]);
        return $returnedCard;
    }

    public function mixTheCards()
    {
        shuffle($this->cards);
    }

    public function isEmpty(): bool
    {
        return empty($this->cards);
    }
}
