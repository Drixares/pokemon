<?php 

// ------------------------------------------------------------
// CLASSE PRINCIPALE
// ------------------------------------------------------------
class Attaque {

    private string $nom;
    private int $puissance;
    private float $precision;
    
    public function __construct(
        string $nom,
        int $puissance,
        float $precision
    ) {
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->precision = $precision;
    }

    /**
     * Inflige des dégâts à l’adversaire en fonction
     * de la puissance et de la précision de l’attaque.
     */
    public function executerAttaque(Pokemon $pokemon): void {
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

