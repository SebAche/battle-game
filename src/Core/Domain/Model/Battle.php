<?php

declare(strict_types=1);

namespace App\Core\Domain\Model;

use App\Core\Domain\Model\Card;
use Symfony\Component\Console\Exception\LogicException;

class Battle
{
    //public int $numberRound;
    public ?Card $cardPlayerOne = null;
    public ?Card $cardPlayerTwo = null;
    public Player $winner;
    public int $winnerCummulatedPoints;

    public function __construct(
        public int $numberRound,
    ) {
    }

    public function attaque(Player $playerOne, Player $playerTwo): void
    {
        $cardPlayerOne = $playerOne->playACard();
        $this->cardPlayerOne = $cardPlayerOne;

        $cardPlayerTwo = $playerTwo->playACard();
        $this->cardPlayerTwo = $cardPlayerTwo;

        $this->winner = $this->cardPlayerOne->getValue() > $this->cardPlayerTwo->getValue() ? $playerOne : $playerTwo;
        $this->winner->addOnePoint();
        $this->winnerCummulatedPoints = $this->winner->getTheCummulatedPoints();
    }
}
