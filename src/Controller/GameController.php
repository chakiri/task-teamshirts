<?php


namespace App\Controller;


use App\Gamer\KnightGamer;

class GameController
{
    public function start()
    {
        $knightGamer = new KnightGamer();

        $knights = $knightGamer->getPlayers();

        $winner = $knightGamer->play();

        require_once(TEMPLATES_DIR . 'game/start.html.php');
    }
}