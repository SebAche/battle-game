<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use App\Core\Domain\Model\Player;

class Game
{
    private array $histo = [];

    public function __construct(
        private Player $playerOne,
        private Player $playerTwo,
        private Deck $initDeck,
    )
    {
        // $initDeck = new Deck();
        // $initDeck->mixTheCards();
    }
    
    public function getIntroGame()
    {
        return sprintf("Card battles opposing %s vs %s (%d cards set)", 
        $this->playerOne->getName(),
        $this->playerTwo->getName(),
        $this->initDeck->getInitNumberOfCards(),
        );
    }

    public function CardsDistributions(): void
    {
        $this->initDeck->mixTheCards();
        $i = 0;
        while (!$this->initDeck->isEmpty()) {
            $i++;
            $card = $this->initDeck->drawTheTopCard();
            if ($i%2 === 0) {
                $this->playerOne->receiveACard($card);
                continue;
            } 

            $this->playerTwo->receiveACard($card);
        }
    }

    public function getPlayerOne(): Player
    {
        return $this->playerOne;
    }

    public function battle(bool $battleDiplayed)
    {
        $maxRound = $this->initDeck->getInitNumberOfCards()/2;
        $round = 1;
        while ($maxRound >= $round) {
            $battle = new Battle($round);
            $battle->attaque($this->playerOne, $this->playerTwo);
            if ($battleDiplayed) {
                $this->histo[] = $battle;
            }
            $round++;
        }
    }

    public function getTheWinner(): ?Player
    {
        if ($this->playerOne->getTheCummulatedPoints() == $this->playerTwo->getTheCummulatedPoints()) {
            return null;
        }
        return $this->playerOne->getTheCummulatedPoints() > $this->playerTwo->getTheCummulatedPoints() ? $this->playerOne : $this->playerTwo;
    }

    public function getTheLooser(): ?Player
    {
        if ($this->playerOne->getTheCummulatedPoints() == $this->playerTwo->getTheCummulatedPoints()) {
            return null;
        }
        return $this->playerOne->getTheCummulatedPoints() < $this->playerTwo->getTheCummulatedPoints() ? $this->playerOne : $this->playerTwo;
    }

    public function getHisto(): array
    {
        return $this->histo;
    }
}
