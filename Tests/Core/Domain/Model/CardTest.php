<?php

declare(strict_types=1);

use App\Core\Domain\Model\Card;
use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    public function testCanBeCreatedFromInteger()
    {
        $this->assertInstanceOf(
            Card::class,
            new Card(6)
        );
    }

    public function testGetTheValueOfTheCard()
    {
        $card = new Card(18);
        $this->assertEquals(
            18,
            $card->getValue()
        );
    }
}
