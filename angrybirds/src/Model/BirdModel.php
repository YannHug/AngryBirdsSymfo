<?php

namespace App\Model;

class BirdModel
{
    private $birds = [
        [
            'name' => 'White bird',
            'description' => 'The chubby white bird drops an egg bomb when players tap the screen after launching the creature from the slingshot.',
            'cost' => 30,
            'image' => 'white.png',
        ],
        [
            'name' => 'Black bird',
            'description' => 'Black birds act as bombs, which explode once they\'ve landed on a target, obliterating pigs and buildings around them.',
            'cost' => 30,
            'image' => 'black.png',
        ],
        [
            'name' => 'Red bird',
            'description' => 'The first avian missile players encounter when they start the game, the red bird follows a simple trajectory when launched.',
            'cost' => 30,
            'image' => 'red.png',
        ],
        [
            'name' => 'Blue bird',
            'description' => 'The blue bird splits into three smaller versions in mid-air when the screen is tapped.',
            'cost' => 20,
            'image' => 'blue.png',
        ],
        [
            'name' => 'Yellow bird',
            'description' => 'Tapping the screen after launching the yellow bird gives the critter a speed boost that makes it more deadly.',
            'cost' => 30,
            'image' => 'yellow.png',
        ],
        [
            'name' => 'Green bird',
            'description' => 'The green bird turns into a boomerang that doubles back to strike targets in otherwise protected locations.',
            'cost' => 25,
            'image' => 'green.png',
        ],
        [
            'name' => 'Big red bird',
            'description' => 'The big red bird is a flying wrecking bail that causes more damage than his smaller red cousin.',
            'cost' => 35,
            'image' => 'big.png',
        ],
    ];

    public function getBirds(): array
    {
        return $this->birds;
    }

    public function getBird(int $index): ?array
    {
        // Pour eviter une erreur de php on verifie l'index si existant
        if (isset($this->birds[$index])) {
            return $this->birds[$index];
        } else {
            return null;
        }
    }
}
