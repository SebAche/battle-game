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
            $playerOneName = $this->cleanStringInput(fread(STDIN, 80));

            echo "and the name of his opponent:" . PHP_EOL;
            $playerTwoName = $this->cleanStringInput(fread(STDIN, 80));

            echo "How many cards do you want to send to battle? [52]" . PHP_EOL;
            $inputNumber = fread(STDIN, 5);
            // $numberOfCards = empty(trim($inputNumber)) ? 52 : (int)$inputNumber;
            $numberOfCards = $this->cleanIntegerInput($inputNumber, 52);

            echo "Do you want to see the battles of this game? (Y/N) [N]" . PHP_EOL;
            // $displayBattle = fread(STDIN, 1);
            // $displayBattle = empty(trim($displayBattle)) ? false : (strtoupper($displayBattle) === 'Y');
            $displayBattle = $this->cleanBooleanInput(fread(STDIN, 1), false);

            // Prepare to plug on the domaine
            $request = new PlayAGameRequest($playerOneName, $playerTwoName, $numberOfCards, $displayBattle);
            $presenter = new PlayAGamePresenter();

            // UseCase
            $playAGame = new PlayAGameUseCase();
            $playAGame->execute($request, $presenter);

            // Render
            $view = new PlayAGameView();
            $view->generateView($presenter);


            echo PHP_EOL . " => Do you want to play a new game? (Y/N) [Y]" . PHP_EOL;
            // $choiceNewGame = trim(fread(STDIN, 2));
            // $newGame = empty($choiceNewGame) ? true : (strtoupper($choiceNewGame) === 'Y');
            $newGame = $this->cleanBooleanInput(fread(STDIN, 2), true);
        }

        echo "Thanks for playing! See you later!" . PHP_EOL;

        return 0;
    }


    private function cleanIntegerInput(string|bool $input, int $defaultValue): int
    {
        if (is_bool($input)) {
            return $defaultValue;
        }
        if (empty(trim($input))) {
            return $defaultValue;
        }

        return (int)trim($input);
    }

    private function cleanBooleanInput(string|bool $input, bool $defaultValue): bool
    {
        if (is_bool($input)) {
            return $defaultValue;
        }
        if (empty(trim($input))) {
            return $defaultValue;
        }
        if (strtoupper(trim($input)) === 'Y') {
            return true;
        }

        return false;
    }

    private function cleanStringInput(string|bool $input): string
    {
        if (is_bool($input)) {
            return '';
        }

        return trim($input);
    }
}
