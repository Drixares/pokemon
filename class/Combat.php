<?php

class Combat {
    public function __construct(
        private Pokemon $pokemon1,
        private Pokemon $pokemon2,
    ) {}

    public function lancerCombat() {
        $this->tourDeCombat($this->pokemon1, $this->pokemon2);
    }
    
    public function tourDeCombat(Pokemon $attaquant, Pokemon $defenseur) {
        $attaquant->attaquer($defenseur);
    }

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


