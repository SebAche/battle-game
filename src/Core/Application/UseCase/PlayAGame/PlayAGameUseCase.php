<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\PlayAGame;

use App\Core\Domain\Model\Game;
use App\Core\Domain\Model\Player;
use App\Core\Domain\Model\Deck;

class PlayAGameUseCase implements PlayAGameUseCaseInterface
{
    /**
     * @var array<string> $errors
     */
    private $errors = [];

    public function execute(PlayAGameRequest $request, PlayAGamePresenterInterface $output): void
    {
        $response = new PlayAGameResponse();
        $this->validateName($request);
        $this->validateNumberOfCards($request);
        if (0 != count($this->errors)) {
            $response->errors = $this->errors;
        } else {
            $game = new Game(
                new Player($request->getPlayerOneName()),
                new Player($request->getPlayerTwoName()),
                (new Deck())->init($request->getNumberOfCards())
            );

            $game->CardsDistributions();
            $game->battle($request->isBattleDisplayed());

            $response->introGame = $game->getIntroGame();
            $response->namePlayerOne = $request->getPlayerOneName();
            $response->namePlayerTwo = $request->getPlayerTwoName();
            $response->histo = $game->getHisto();
            $response->errors = $this->errors;

            if ($game->getTheWinner() instanceof Player && $game->getTheLooser() instanceof Player) {
                $response->exAequo = false;
                $response->winnerName = $game->getTheWinner()->getName();
                $response->winnerScore = $game->getTheWinner()->getTheCummulatedPoints();
                $response->looserScore = $game->getTheLooser()->getTheCummulatedPoints();
            }
        }

        $output->present($response);
    }

    private function validateName(PlayAGameRequest $request): void
    {
        if (empty($request->getPlayerOneName()) || empty($request->getPlayerTwoName())) {
            $this->errors[] = 'A player name cannot be empty.';
        }

        if ($request->getPlayerOneName() === $request->getPlayerTwoName()) {
            $this->errors[] = 'Each player name should be unique.';
        }
    }

    private function validateNumberOfCards(PlayAGameRequest $request): void
    {
        if ($request->getNumberOfCards() <= 0) {
            $this->errors[] = 'The number of cards must be higher than zero.';
        }

        if ($request->getNumberOfCards()%2 != 0) {
            $this->errors[] = 'The number of cards must be an EVEN number.';
        }
    }
}
