<?php
abstract class Pokemon {
    protected $nom;
    protected $type;
    protected $pointsDeVie;
    protected $puissanceAttaque;
    protected $defense;

    public function __construct($nom, $type, $pointsDeVie, $puissanceAttaque, $defense) {
        $this->nom = $nom;
        $this->type = $type;
        $this->pointsDeVie = $pointsDeVie;
        $this->puissanceAttaque = $puissanceAttaque;
        $this->defense = $defense;
    }

    // Méthode pour obtenir le nom du Pokémon
    public function getNom() {
        return $this->nom;
    }

    // Méthode pour obtenir les points de vie du Pokémon
    public function getHp() {
        return $this->pointsDeVie;
    }

    // Méthode pour attaquer un adversaire
    public function attaquer($adversaire) {
        $degats = $this->puissanceAttaque - $adversaire->defense;
        if ($degats > 0) {
            $adversaire->recevoirDegats($degats);
        }
    }

    // Méthode pour réduire les points de vie
    public function recevoirDegats($degats) {
        $this->pointsDeVie -= $degats;
    }

    // Vérifier si le Pokémon est KO
    public function estKO() {
        return $this->pointsDeVie <= 0;
    }

    // Méthode abstraite pour la capacité spéciale
    abstract public function capaciteSpeciale($adversaire);
}
?>
