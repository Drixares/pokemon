<?php
require_once 'Pokemon.php';

class PokemonPlante extends Pokemon {
    public function __construct($nom, $pointsDeVie, $puissanceAttaque, $defense) {
        parent::__construct($nom, 'Plante', $pointsDeVie, $puissanceAttaque, $defense);
    }

    public function capaciteSpeciale($adversaire) {
        if ($adversaire instanceof PokemonEau) {
            $degats = 15;  // Attaque spéciale pour infliger plus de dégâts aux Pokémon Eau
            echo $this->nom . " utilise Végé-Herbe! Dégâts: " . $degats . "<br>";
            $adversaire->recevoirDegats($degats);
        }
    }
}
?>
