<?php
require_once 'Pokemon.php';

class PokemonFeu extends Pokemon {
    public function __construct($nom, $pointsDeVie, $puissanceAttaque, $defense) {
        parent::__construct($nom, 'Feu', $pointsDeVie, $puissanceAttaque, $defense);
    }

    public function capaciteSpeciale($adversaire) {
        if ($adversaire instanceof PokemonPlante) {
            $degats = 25;  // Attaque spéciale pour infliger plus de dégâts à Pokémon Plante
            echo $this->nom . " utilise Flammes! Dégâts: " . $degats . "<br>";
            $adversaire->recevoirDegats($degats);
        }
    }
}
?>
