<?php 

// ------------------------------------------------------------
// CLASSE PRINCIPALE
// ------------------------------------------------------------
class Attaque {
    public function __construct(
        public string $nom,
        public int $puissance,
        public float $precision,
    ) {}

    public function executer(Pokemon $pokemon) {
        // random float between 0 and 1
        $random = mt_rand() / mt_getrandmax();
        if ($random <= $this->precision) {
            $pokemon->recevoirDegats($this->puissance);
        } else {
            echo '<p>'.$this->nom.' a manqué !</p>';
        }
    }
}

?>

