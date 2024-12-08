<?php 

require_once 'Traits/Soins.php';
require_once 'interfaces/Combattant.php';
require_once 'class/Combat.php';
require_once 'class/Attaque.php';

// ------------------------------------------------------------
// CLASSE PRINCIPALE
// ------------------------------------------------------------
abstract class Pokemon implements Combattant {
    use Soins;
   
    protected string $nom;
    protected string $type;
    protected int $hp;
    protected int $maxHp;
    protected int $attaque;
    protected array $image;
    // protected Capacite $capaciteNormale;
    // protected Capacite $capaciteSpeciale;

    public function __construct(
      string $nom,
      string $type,
      int $hp, 
      int $maxHp, 
      int $attaque,
      array $image 
    ) {
      $this->nom = $nom;
      $this->type = $type;
      $this->hp = $hp;
      $this->maxHp = $maxHp;
      $this->attaque = $attaque;
      $this->image = $image;
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

    // Méthodes de l'interface Combattant
    public function seBattre(Combattant $oponent): void {
        $combat = new Combat($this, $oponent);
        $combat->lancerCombat();
    }

    public function utiliserCapaciteSpeciale(Pokemon $adversaire): void {
        $this->capaciteSpeciale($adversaire);
    }

    // Les enfants devront définir cette méthode :
    abstract public function capaciteSpeciale(Pokemon $adversaire);
      

    /**
     * Attaque l’adversaire reçu en paramètres 
     * et réduit ses points de vie en fonction de la puissance d’attaque
     * et de la défense.
     */
    public function attaquer(Pokemon $adversaire) {
      $degats = $this->attaque;
      $adversaire->recevoirDegats($degats);
      echo $this->nom . ' attaque ' . $adversaire->nom . ' avec ' . $degats . ' de dégats' . PHP_EOL;
    }

    /**
     * Réduit les points de vie en fonction des dégâts reçus.
     */
    public function recevoirDegats(Int $degats) {
      $this->hp -= $degats;
    }

    /**
     * Vérifie si les points de vie sont à zéro.
     */
    public function isKo() {
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
    int $attaque, 
    array $image
  ) {
    parent::__construct($nom, "feu", $hp, $maxHp, $attaque, $image);
  }
  

  public function capaciteSpeciale(Pokemon $adversaire) {
    if ($adversaire->type === $this->type_force) {
      $flammeche = new Attaque('Flammeche', 10 + 5, 0.7);
      $flammeche->executerAttaque($adversaire);
    } else {
      $flammeche = new Attaque('Flammeche', 10, 0.7);
      $flammeche->executerAttaque($adversaire);
    }
  }
}

class PokemonPlante extends Pokemon { 

  protected $type_force = 'eau';

  public function __construct(
    string $nom,
    int $hp, 
    int $maxHp, 
    int $attaque, 
    array $image
  ) {
    parent::__construct($nom, "plante", $hp, $maxHp, $attaque, $image);
  }
  

  public function capaciteSpeciale(Pokemon $adversaire) {
    if ($adversaire->type === $this->type_force) {
      $fouetLiane = new Attaque('Fouet Liane', 10 + 5, 0.7);
      $fouetLiane->executerAttaque($adversaire);
    } else {
      $fouetLiane = new Attaque('Fouet Liane', 10, 0.7);
      $fouetLiane->executerAttaque($adversaire);
    }
  }
}

class PokemonEau extends Pokemon {

  protected $type_force = 'feu';

  public function __construct(
    string $nom,
    int $hp, 
    int $maxHp, 
    int $attaque, 
    array $image
  ) {
    parent::__construct($nom, "eau", $hp, $maxHp, $attaque, $image);
  }
  
  public function capaciteSpeciale(Pokemon $adversaire) {
    
    if ($adversaire->type === $this->type_force) {
      $hydrocanon = new Attaque('Hydrocanon', 10 + 5, 0.7);
      $hydrocanon->executerAttaque($adversaire);
    } else {
      $hydrocanon = new Attaque('Hydrocanon', 10, 0.7);
      $hydrocanon->executerAttaque($adversaire);
    }
  }
}

?>
