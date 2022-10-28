<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\PlayAGame;

interface PlayAGamePresenterInterface
{
    public function present(PlayAGameResponse $response): void;
}
