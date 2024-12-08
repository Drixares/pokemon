<?php

class Combat {

    private Pokemon $pokemon1;
    private Pokemon $pokemon2;
    private int $turn;

    public function __construct(
        Pokemon $pokemon1,
        Pokemon $pokemon2
    ) {
        $this->pokemon1 = $pokemon1;
        $this->pokemon2 = $pokemon2;
    }

    /**
     * Lance le combat et fait attaquer chaque Pokémon à tour de rôle.
     */
    public function lancerCombat(): void {
        $this->turn = rand(1, 2);
    }

    public function getTurn(): int {
        return $this->turn;
    }

    public function setTurn(int $turn): void {
        if ($turn !== 0 && $turn !== 1 && $turn !== 2) {
            throw new InvalidArgumentException("Le tour doit être égal à 0, 1 ou 2.");
        }
        $this->turn = $turn;
    }

    public function determinerWinner(Pokemon $pokemon1, Pokemon $pokemon2): Pokemon {
        if ($pokemon1->getPointsDeVie() > $pokemon2->getPointsDeVie()) {
            return $pokemon1;
        } else {
            return $pokemon2;
        }
    }
}


