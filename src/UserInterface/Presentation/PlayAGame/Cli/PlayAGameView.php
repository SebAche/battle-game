<?php

declare(strict_types=1);

namespace App\UserInterface\Presentation\PlayAGame\Cli;

use App\Core\Domain\Model\Card;

class PlayAGameView
{
    public function generateView(PlayAGamePresenter $presenter): void
    {
        $viewModel = $presenter->getViewModel();

        if (0 != count($viewModel->errors)) {
            echo "================ ERROR ===================" . PHP_EOL;
            foreach ($viewModel->errors as $error) {
                echo "=> ". $error . PHP_EOL;
            }
            echo "==========================================" . PHP_EOL;
            return;
        }

        echo PHP_EOL ."====================================================" . PHP_EOL;
        echo $viewModel->introGame  . PHP_EOL;
        echo "====================================================" . PHP_EOL ;

        if ($viewModel->exAequo) {
            $result = PHP_EOL ."This game ended in a draw!" . PHP_EOL ;
        } else {
            $result = sprintf(
                PHP_EOL ."And the winner is ... %s ! with a score of %d points. \nFar ahead of the loser's %d points!" . PHP_EOL,
                strtoupper($viewModel->winnerName),
                $viewModel->winnerScore,
                $viewModel->looserScore
            );
        }

        echo $result;

        if (0 != count($viewModel->histo)) {
            echo PHP_EOL ."==================== BATTLES HISTORY ======================" . PHP_EOL;
            foreach ($viewModel->histo as $battle) {
                $line = sprintf(
                    "Round %d : %d (%s) vs %d (%s) => Winner : %s (%d points)" . PHP_EOL,
                    $battle->numberRound,
                    $battle->cardPlayerOne instanceof Card ? $battle->cardPlayerOne->getValue() : 'Error',
                    $viewModel->namePlayerOne,
                    $battle->cardPlayerTwo instanceof Card ? $battle->cardPlayerTwo->getValue() : 'Error',
                    $viewModel->namePlayerTwo,
                    $battle->winner->getName(),
                    $battle->winnerCummulatedPoints,
                );
                echo $line;
            }
            echo "===========================================================" . PHP_EOL;
        }
    }
}
