<?php

declare(strict_types=1);

namespace App\UserInterface\Presentation\PlayAGame\Cli;


class PlayAGameView
{

    public function generateView(PlayAGamePresenter $presenter): void
    {
        $viewModel = $presenter->getViewModel();

        if (0 != count($viewModel->errors)) {
            echo "================ ERROR ===================" . PHP_EOL;
            foreach($viewModel->errors as $error){
                echo "* ". $error . PHP_EOL;
            }
            echo "==========================================" . PHP_EOL;
            return;
        }

        echo PHP_EOL ."====================================================" . PHP_EOL;
        echo $viewModel->introGame  . PHP_EOL;
        echo "====================================================" . PHP_EOL ;
        $result = sprintf( PHP_EOL ."And the winner is ... %s ! with a score of %d points. \nFar ahead of the loser's %d points!" . PHP_EOL ,
            strtoupper($viewModel->winnerName),
            $viewModel->winnerScore,
            $viewModel->looserScore
            );
        echo $result;

        if (0 != count($viewModel->histo)) {
            echo PHP_EOL ."================ History of the battles ===================" . PHP_EOL;
            foreach($viewModel->histo as $battle){
                $line = sprintf("Round %d : %d (%s) vs %d (%s) => Winner : %s (%d points)" . PHP_EOL,
                $battle->numberRound,
                $battle->cardPlayerOne->getValue(),
                $viewModel->namePlayerOne,
                $battle->cardPlayerTwo->getValue(),
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