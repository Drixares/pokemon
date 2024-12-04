<?php

abstract class Pokemon{
  private $name;
  private $type;
  private $pv;
  private $puissanceattack;
  private $defense;

  public function __construct(
    string $name,
    string $type,
    int $pv,
    int $puissanceattack,
    int $defense
  ){
    $this->setName($name);
    $this->setType($type);
    $this->setPv($pv);
    $this->setPuissanceattack($puissanceattack);
    $this->setDefense($defense);
  }

  //liste des méthodes get et set

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;
  }

  public function getType(){
    return $this->type;
  }

  public function setType($type){
    $this->type = $type;
  }

  public function getPv(){
    return $this->pv;
  }

  public function setPv($pv){
    $this->pv = $pv;
  }

  public function getPuissanceattack(){
    return $this->puissanceattack;
  }

  public function setPuissanceattack($puissanceattack){
    $this->puissanceattack = $puissanceattack;
  }

  public function getDefense(){
    return $this->defense;
  }

  public function setDefense($defense){
    $this->defense = $defense;
  }

  // attaquer(adversaire) : attaque l’adversaire reçu en paramètres et réduit ses points de vie en fonction de la puissance d’attaque et de la défense.

  public function attaquer($adversaire){
    $adversaire->setPv($adversaire->getPv() - ($this->getPuissanceattack() - $adversaire->getDefense()));
  }

  //recevoirDegats(degats) : réduit les points de vie en fonction des dégâts reçus.

  public function recevoirDegats($degats){
    $this->setPv($this->getPv() - $degats);
  }

  //estKO() : vérifie si les points de vie sont à zéro.

  public function estKO(){
    return $this->getPv() <= 0;
  }
  //Méthode abstraite capaciteSpeciale(adversaire) : chaque sous-classe aura une capacité spéciale unique.
  //Créer des sous-classes pour chaque type de Pokémon (par exemple, PokemonFeu, PokemonEau, PokemonPlante).
  //Implémenter la méthode capaciteSpeciale() dans chaque sous-classe :
  //PokemonFeu : attaque spéciale Lance-Flammes qui inflige des dégâts supplémentaires aux Pokémon Plante.
  //PokemonEau : attaque spéciale Hydrocanon qui inflige des dégâts supplémentaires aux Pokémon Feu.
  //PokemonPlante : attaque spéciale Fouet-Lianes qui inflige des dégâts supplémentaires aux Pokémon Eau.
  //Utiliser des bonus et malus pour modéliser les forces et faiblesses de chaque type de Pokémon.
    

  abstract public function capaciteSpeciale($adversaire);
  
  
}
