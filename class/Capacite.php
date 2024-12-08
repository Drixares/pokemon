<?php

class Capacite
{
    protected array $capaciteFaiblesse = [
        "feu" => "plante",
        "eau" => "feu",
        "plante" => "eau"
    ];

    private string $nom;
    private int $degats;
    private float $precision;
    private string $type;

    public function __construct(string $nom, int $degats, float $precision, string $type)
    {
        $this->nom = $nom;
        $this->degats = $degats;
        $this->precision = $precision;
        $this->type = $type;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getDegats(): int
    {
        return $this->degats;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPrecision(): float
    {
        return $this->precision;
    }

    /**
     * Inflige des dégâts à l’adversaire en fonction
     * de la puissance et de la précision de l’attaque.
     */
    public function executerCapacite(Pokemon $adversaire): bool {

        $degats = $this->degats;

        if ($adversaire->getType() == $this->capaciteFaiblesse[$this->type]) {
            $degats += 10;
        }

        $random = mt_rand() / mt_getrandmax();
        if ($random <= $this->precision) {
            $adversaire->recevoirDegats($degats);
            return true;
        }

        return false;
    }
}

class CapaciteSpecialeFeu extends Capacite
{
    public function __construct()
    {
        parent::__construct("Lance-Flammes", 45, 0.95, "feu");
    }
}

class CapaciteSpecialeEau extends Capacite
{
    public function __construct()
    {
        parent::__construct("Hydrocanon", 45, 0.95, "eau");
    }
}

class CapaciteSpecialePlante extends Capacite
{
    public function __construct()
    {
        parent::__construct("Fouet-Lianne", 45, 0.95, "plante");
    }
}
