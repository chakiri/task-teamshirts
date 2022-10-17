<?php


namespace App\Gamer;


use App\Entity\Knight;
use App\Entity\Player;
use Faker\Factory;

class KnightGamer implements PlayerGamer
{
    public const MIN_PLAYERS = 2;
    public const MAX_PLAYERS = 20;
    public const LIFE_POINT = 100;

    private array $players = [];

    private $faker;

    /*
     * Constitute teams of players
     * @return array
     */
    public function getPlayers(): array
    {
        $this->faker = Factory::create();

        //Get random number of players
        for ($i = 0; $i < rand(self::MIN_PLAYERS, self::MAX_PLAYERS); $i++){
            $knight = new Knight();

            $knight->setName($this->faker->name);
            $knight->setPoints(self::LIFE_POINT);

            $this->players[] = $knight;
        }

        return $this->players;
    }

    /**
     * Loop into the game
     * @return Player
     */
    public function play(): Player
    {
        //Game loop
        while (true){
            for ($i = 0; $i < count($this->players); $i++){
                //Thrown dice
                $dice = rand(1, 6);

                //Get next player
                $nextPlayerIndex = $i + 1;
                //If last item restart from the beginning
                if (!isset($this->players[$nextPlayerIndex])){
                    $nextPlayerIndex = 0;
                }

                //Subtract next player life point
                $points = $this->players[$nextPlayerIndex]->getPoints() - $dice;
                $this->players[$nextPlayerIndex]->setPoints($points);

                //If no more points, he die
                if ($this->players[$nextPlayerIndex]->getPoints() <= 0){
                    unset($this->players[$nextPlayerIndex]);
                    //Reindex array
                    $this->players = array_values($this->players);
                }

                //If last player, he win
                if (count($this->players) === 1){
                    return $this->players[0];
                }
            }
        }
    }
}