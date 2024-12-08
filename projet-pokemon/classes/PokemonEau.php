<?php
require_once 'Pokemon.php';

class PokemonEau extends Pokemon {
    public function __construct($nom, $pointsDeVie, $puissanceAttaque, $defense) {
        parent::__construct($nom, 'Eau', $pointsDeVie, $puissanceAttaque, $defense);
    }

    public function capaciteSpeciale($adversaire) {
        if ($adversaire instanceof PokemonFeu) {
            $degats = 20;  // Hydrocanon inflige des dégâts supplémentaires aux Pokémon Feu
            echo $this->nom . " utilise Hydrocanon! Dégâts: " . $degats . "<br>";
            $adversaire->recevoirDegats($degats);
        }
    }
}
?>
