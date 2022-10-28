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
        // $initDeck = New Deck();
        // $initDeck->mixTheCards();
    }
    
    public function getIntroGame()
    {
        return sprintf("This game is a %d card battle opposing %s and %s", 
            $this->initDeck->getInitNumberOfCards(),
            $this->playerOne->getName(),
            $this->playerTwo->getName()
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
            $battle = New Battle($round);
            $battle->attaque($this->playerOne, $this->playerTwo);
            if ($battleDiplayed) {
                $this->histo[] = $battle;
            }
            $round++;
        }
    }

    public function getTheWinner(): Player
    {
        return $this->playerOne->getTheCummulatedPoints() > $this->playerTwo->getTheCummulatedPoints() ? $this->playerOne : $this->playerTwo;
    }

    public function getTheLooser(): Player
    {
        return $this->playerOne->getTheCummulatedPoints() < $this->playerTwo->getTheCummulatedPoints() ? $this->playerOne : $this->playerTwo;
    }

    public function getHisto(): array
    {
        return $this->histo;
    }
}
