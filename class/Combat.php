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
    public function lancerCombat() {
        $this->turn = rand(1, 2);
    }
    
    /**
     * Effectue une attaque du Pokémon attaquant sur le défenseur.
     */
    public function tourDeCombat(Pokemon $attaquant, Pokemon $defenseur) {
        $attaquant->attaquer($defenseur);
    }

    /**
     * Détermine le vainqueur en fonction des points de vie restants.
     */
    public function determinerGagnant() {
        if ($this->pokemon1->isKo()) {
            return $this->pokemon2;
        } else if ($this->pokemon2->isKo()) {
            return $this->pokemon1;
        } else {
            return null;
        }
    }
}


