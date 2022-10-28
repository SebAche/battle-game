<?php

declare(strict_types=1);

namespace App\UserInterface\Presentation\PlayAGame\Cli;

class PlayAGameViewModel
{
    public function __construct(
        public string $introGame = '',
        public bool $exAequo = true,
        public string $winnerName = '',
        public string $namePlayerOne = '',
        public string $namePlayerTwo = '',
        public int $winnerScore = 0,
        public int $looserScore = 0,
        public array $histo = [],
        public array $errors = []
    ) {
    }
}
