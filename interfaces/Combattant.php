<?php

interface Combattant {
    /**
     * Démarre un combat contre un autre Pokémon.
     */
    public function seBattre(Pokemon $oponent);

    /**
     * Utilise l’attaque spéciale du Pokémon contre un adversaire.
     */
    public function utiliserCapaciteSpeciale(Pokemon $oponent);
}

?>

