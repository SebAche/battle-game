<?php

declare(strict_types=1);

namespace App\UserInterface\Cli;

use App\Core\Application\UseCase\PlayAGame\PlayAGameRequest;
use App\Core\Application\UseCase\PlayAGame\PlayAGameUseCase;
use App\UserInterface\Presentation\PlayAGame\Cli\PlayAGamePresenter;
use App\UserInterface\Presentation\PlayAGame\Cli\PlayAGameView;

class PlayAGameCommand
{
    public function execute(): int
    {
         // Form to init a game
        echo "Hello! What is the name of the first player:\n";
        $playerOneName = fread(STDIN, 80);

        echo "and the name of his opponent:\n";
        $playerTwoName = fread(STDIN, 80);

        echo "How many cards do you want to send to battle? [52]\n";
        $inputNumber = fread(STDIN, 5);
        $numberOfCards = empty(trim($inputNumber)) ? 52 : (int)$inputNumber;

        echo "Do you want to see the battles of this game? (Y/N) [N]\n";
        $displayBattle = fread(STDIN, 1);
        $displayBattle = empty(trim($displayBattle)) ? false : (strtoupper($displayBattle) === 'Y');

        // Prepare to plug on the domaine
        $request = New PlayAGameRequest($playerOneName, $playerTwoName, $numberOfCards, $displayBattle);
        $presenter = New PlayAGamePresenter();

        // UseCase
        $playAGame = New PlayAGameUseCase();
        $playAGame->execute($request, $presenter);

        // Render
        $view = New PlayAGameView();
        $view->generateView($presenter);

        return 0;
    }
}
