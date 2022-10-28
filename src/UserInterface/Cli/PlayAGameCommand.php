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

        $newGame = true;

        echo "Hello and welcome to this simplified battle game!" . PHP_EOL;

        while ($newGame) {

         // Form to init a game
        echo "What is the name of the first player:" . PHP_EOL;
        $playerOneName = fread(STDIN, 80);

        echo "and the name of his opponent:" . PHP_EOL;
        $playerTwoName = fread(STDIN, 80);

        echo "How many cards do you want to send to battle? [52]" . PHP_EOL;
        $inputNumber = fread(STDIN, 5);
        $numberOfCards = empty(trim($inputNumber)) ? 52 : (int)$inputNumber;

        echo "Do you want to see the battles of this game? (Y/N) [N]" . PHP_EOL;
        $displayBattle = fread(STDIN, 1);
        $displayBattle = empty(trim($displayBattle)) ? false : (strtoupper($displayBattle) === 'Y');

        // Prepare to plug on the domaine
        $request = new PlayAGameRequest($playerOneName, $playerTwoName, $numberOfCards, $displayBattle);
        $presenter = new PlayAGamePresenter();

        // UseCase
        $playAGame = new PlayAGameUseCase();
        $playAGame->execute($request, $presenter);

        // Render
        $view = new PlayAGameView();
        $view->generateView($presenter);


        echo PHP_EOL . " => Do you want to play a new game? (Y/N) [N]" . PHP_EOL;
        $choiceNewGame = trim(fread(STDIN, 2));
        $newGame = empty($choiceNewGame) ? false : (strtoupper($choiceNewGame) === 'Y');

        }

        echo "Thanks for playing! See you later!" . PHP_EOL;

        return 0;
    }
}
