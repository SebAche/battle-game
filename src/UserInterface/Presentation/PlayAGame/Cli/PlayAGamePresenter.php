<?php

declare(strict_types=1);

namespace App\UserInterface\Presentation\PlayAGame\Cli;

use App\Core\Application\UseCase\PlayAGame\PlayAGamePresenterInterface;
use App\Core\Application\UseCase\PlayAGame\PlayAGameResponse;

class PlayAGamePresenter implements PlayAGamePresenterInterface
{
    private PlayAGameViewModel $viewModel;

    public function present(PlayAGameResponse $response): void
    {
        // var_dump($response); 
        $this->viewModel = new PlayAGameViewModel(
            $response->introGame,
            $response->exAequo,
            $response->winnerName,
            $response->namePlayerOne,
            $response->namePlayerTwo,
            $response->winnerScore,
            $response->looserScore,
            $response->histo,
            $response->errors,
        );
    }

    public function getViewModel(): PlayAGameViewModel
    {
        // var_dump($this->viewModel);die;
        return $this->viewModel;
    }
}