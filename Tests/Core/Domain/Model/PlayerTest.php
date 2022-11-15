<?php

declare(strict_types=1);

use App\Core\Domain\Model\Deck;
use App\Core\Domain\Model\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testCanBeCreatedWithName()
    {
        $this->assertInstanceOf(
            Player::class,
            new Player('Bob')
        );
    }

    public function testGetTheEmptyDeck()
    {
        $player = new Player('Bob');

        $this->assertInstanceOf(
            Deck::class,
            $player->getDeck()
        );

        $this->assertEquals(
            0,
            count($player->getDeck()->getCards())
        );
    }
}