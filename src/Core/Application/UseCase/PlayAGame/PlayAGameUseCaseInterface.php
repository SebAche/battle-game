<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\PlayAGame;

interface PlayAGameUseCaseInterface
{
    public function execute(PlayAGameRequest $request, PlayAGamePresenterInterface $output): void;
}