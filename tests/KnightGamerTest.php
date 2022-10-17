<?php

use App\Entity\Player;
use App\Gamer\KnightGamer;
use PHPUnit\Framework\TestCase;

class KnightGamerTest extends TestCase
{
    private $knightGamer;

    protected function setUp(): void
    {
        $this->knightGamer = new KnightGamer();
    }

    public function testGetPlayersIsNotEmpty()
    {
        $this->assertNotEmpty($this->knightGamer->getPlayers());
    }

    public function testMinPlayersConstanteValueIsGreaterThanOrEqualTwo()
    {
        $this->assertGreaterThanOrEqual(2, $this->knightGamer::MIN_PLAYERS);
    }

    public function testReturnPlayFunctionInstanceOfPlayer()
    {
        $knightGamer = new KnightGamer();

        $knights = $knightGamer->getPlayers();

        $winner = $knightGamer->play();

        $this->assertInstanceOf(Player::class, $winner);
    }
}