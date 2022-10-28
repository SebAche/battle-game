<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use App\Core\Domain\Model\Card;

class Battle
{
    //public int $numberRound;
    public Card $cardPlayerOne;
    public Card $cardPlayerTwo;
    public Player $winner;
    public int $winnerCummulatedPoints;

    public function __construct(
        public int $numberRound,
    ) {
    }

    public function attaque(Player $playerOne, Player $playerTwo)
    {
        $this->cardPlayerOne = $playerOne->playACard();
        $this->cardPlayerTwo = $playerTwo->playACard();
        $this->winner = $this->cardPlayerOne->getValue() > $this->cardPlayerTwo->getValue() ? $playerOne : $playerTwo;
        $this->winner->addOnePoint();
        $this->winnerCummulatedPoints = $this->winner->getTheCummulatedPoints();
    }
}
