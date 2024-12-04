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
   
    public function __construct(
        protected string $nom,
        protected int $hp,
        protected int $maxHp,
        protected int $attaque,
        protected int $defense,
        protected string $type
      ){}

    // Méthodes de l'interface Combattant
    public function seBattre(Combattant $oponent) {
        $combat = new Combat($this, $oponent);
        $combat->lancerCombat();
    }

    public function utiliserCapaciteSpeciale(Pokemon $adversaire) {
        $this->capaciteSpeciale($adversaire);
    }

    // Les enfants devront définir cette méthode :
    abstract public function capaciteSpeciale(Pokemon $adversaire);
      
    // Les enfants pourront utiliser cette méthode
    // mais n'auront pas l'obligation de la réécrire :
    public function attaquer(Pokemon $adversaire) {
      $degats = $this->attaque;
      $adversaire->recevoirDegats($degats);
      echo $this->nom . ' attaque ' . $adversaire->nom . ' avec ' . $degats . ' de dégats' . PHP_EOL;
    }

    public function recevoirDegats(Int $degats) {
      $this->hp -= $degats;
    }

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
    int $defense
  ) {
    parent::__construct($nom, $hp, $maxHp, $attaque, $defense);
  }
  

  public function capaciteSpeciale(Pokemon $adversaire) {
    if ($adversaire->type === $this->type_force) {
      $flammeche = new Attaque('Flammeche', 10 + 5, 0.7);
      $flammeche->executer($adversaire);
    } else {
      $flammeche = new Attaque('Flammeche', 10, 0.7);
      $flammeche->executer($adversaire);
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
    int $defense
  ) {
    parent::__construct($nom, $hp, $maxHp, $attaque, $defense);
  }
  

  public function capaciteSpeciale(Pokemon $adversaire) {
    if ($adversaire->type === $this->type_force) {
      $fouetLiane = new Attaque('Fouet Liane', 10 + 5, 0.7);
      $fouetLiane->executer($adversaire);
    } else {
      $fouetLiane = new Attaque('Fouet Liane', 10, 0.7);
      $fouetLiane->executer($adversaire);
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
    int $defense
  ) {
    parent::__construct($nom, $hp, $maxHp, $attaque, $defense);
  }
  
  public function capaciteSpeciale(Pokemon $adversaire) {
    
    if ($adversaire->type === $this->type_force) {
      $hydrocanon = new Attaque('Hydrocanon', 10 + 5, 0.7);
      $hydrocanon->executer($adversaire);
    } else {
      $hydrocanon = new Attaque('Hydrocanon', 10, 0.7);
      $hydrocanon->executer($adversaire);
    }
  }
}

?>
