<?php

declare(strict_types=1);

namespace App\Core\Application\UseCase\PlayAGame;

use App\Core\Domain\Model\Battle;

class PlayAGameResponse
{
    /**
     * @param array<Battle> $histo
     * @param array<string> $errors
     */
    public function __construct(
        public string $introGame = '',
        public string $namePlayerOne = '',
        public string $namePlayerTwo = '',
        public bool $exAequo = true,
        public string $winnerName = '',
        public int $winnerScore = 0,
        public int $looserScore = 0,
        public array $histo = [],
        public array $errors = []
    ) {
    }
}
