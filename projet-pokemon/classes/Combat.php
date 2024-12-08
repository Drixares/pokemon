<?php
class Combat {
    private $pokemon1;
    private $pokemon2;

    public function __construct($pokemon1, $pokemon2) {
        $this->pokemon1 = $pokemon1;
        $this->pokemon2 = $pokemon2;
    }

    public function demarrerCombat() {
        while (!$this->pokemon1->estKO() && !$this->pokemon2->estKO()) {
            // Pokémon 1 attaque Pokémon 2
            $this->pokemon1->attaquer($this->pokemon2);
            echo $this->pokemon1->getNom() . " attaque " . $this->pokemon2->getNom() . " !<br>";

            // Vérification si Pokémon 2 est KO
            if ($this->pokemon2->estKO()) {
                echo $this->pokemon2->getNom() . " est KO !<br>";
                break;
            }

            // Pokémon 2 attaque Pokémon 1
            $this->pokemon2->attaquer($this->pokemon1);
            echo $this->pokemon2->getNom() . " attaque " . $this->pokemon1->getNom() . " !<br>";

            // Vérification si Pokémon 1 est KO
            if ($this->pokemon1->estKO()) {
                echo $this->pokemon1->getNom() . " est KO !<br>";
                break;
            }
        }
    }
}
?>
