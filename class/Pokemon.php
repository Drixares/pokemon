<?php 

require_once 'Traits/Soins.php';
require_once 'interfaces/Combattant.php';
require_once 'class/Combat.php';
require_once 'class/Capacite.php';

// ------------------------------------------------------------
// CLASSE PRINCIPALE
// ------------------------------------------------------------
abstract class Pokemon implements Combattant {
    use Soins;
   
    protected string $nom;
    protected string $type;
    protected int $hp;
    protected int $maxHp;
    protected array $image;
    protected Capacite $attaqueNormale;
    protected Capacite $attaqueSpeciale;

    public function __construct(
      string $nom,
      string $type,
      int $hp, 
      int $maxHp, 
      array $image,
      Capacite $attaqueNormale,
      Capacite $attaqueSpeciale
    ) {
      $this->nom = $nom;
      $this->type = $type;
      $this->hp = $hp;
      $this->maxHp = $maxHp;
      $this->image = $image;
      $this->attaqueNormale = $attaqueNormale;
      $this->attaqueSpeciale = $attaqueSpeciale;
    }

    public function getPointsDeVie(): int {
      return $this->hp;
    }

    public function getNom(): string {
      return $this->nom;
    }

    public function getMaxPointsDeVie(): int {
      return $this->maxHp;
    }

    public function getType(): string {
      return $this->type;
    }

    public function getImage(string $position): string {
      if (!in_array($position, ['front', 'back'])) {
        throw new InvalidArgumentException('Position must be either "front" or "back".');
      }
      return $this->image[$position];
    }

    public function getAttaqueNormale(): Capacite {
      return $this->attaqueNormale;
    }

    public function getAttaqueSpeciale(): Capacite {
      return $this->attaqueSpeciale;
    }

    public function seBattre(Combattant $oponent): void {
        $combat = new Combat($this, $oponent);
        $combat->lancerCombat();
    }

    public function utiliserCapaciteSpeciale(Pokemon $adversaire): bool {
      $attaqueSpeciale = $this->getAttaqueSpeciale();
      return $attaqueSpeciale->executerCapacite($adversaire);
    }      

    public function utiliserCapaciteNormale(Pokemon $adversaire): bool {

      $attaqueNormale = $this->getAttaqueNormale();
      return $attaqueNormale->executerCapacite($adversaire);
    }

    /**
     * Réduit les points de vie en fonction des dégâts reçus.
     */
    public function recevoirDegats(int $degats): void {
      $this->hp -= $degats;
    }

    /**
     * Vérifie si les points de vie sont à zéro.
     */
    public function estKO() {
      return $this->hp <= 0;
    }
}

// ------------------------------------------------------------
// SOUS-CLASSES
// ------------------------------------------------------------
class PokemonFeu extends Pokemon {

  protected $type_force = 'plante';

  public function __construct(
    string $nom,
    int $hp, 
    int $maxHp, 
    array $image,
    array $capacite_normale
  ) {
    ['nom' => $nom_capacite, 'degats' => $degats, 'precision' => $precision] = $capacite_normale;
    parent::__construct($nom, "feu", $hp, $maxHp, $image, new Capacite($nom_capacite, $degats, $precision, "feu"), new CapaciteSpecialeFeu());
  }
}

class PokemonPlante extends Pokemon { 

  protected $type_force = 'eau';

  public function __construct(
    string $nom,
    int $hp, 
    int $maxHp, 
    array $image,
    array $capacite_normale
  ) {
    ['nom' => $nom_capacite, 'degats' => $degats, 'precision' => $precision] = $capacite_normale;
    parent::__construct($nom, "plante", $hp, $maxHp, $image, new Capacite($nom_capacite, $degats, $precision, "plante"), new CapaciteSpecialePlante());
  }
}

class PokemonEau extends Pokemon {

  protected $type_force = 'feu';

  public function __construct(
    string $nom,
    int $hp, 
    int $maxHp, 
    array $image,
    array $capacite_normale
  ) {
    ['nom' => $nom_capacite, 'degats' => $degats, 'precision' => $precision] = $capacite_normale;
    parent::__construct($nom, "eau", $hp, $maxHp, $image, new Capacite($nom_capacite, $degats, $precision, "eau"), new CapaciteSpecialeEau());
  }
}
?>
