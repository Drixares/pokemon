<?php

require_once 'class/Pokemon.php';
require_once 'class/Combat.php';

$tortipouss = new PokemonEau(
    nom:'Tortipouss', 
    hp:100, 
    maxHp:100, 
    attaque:10, 
    defense:10
);

$bulbizarre = new PokemonPlante(
    nom:'Bulbizarre', 
    hp:100, 
    maxHp:100, 
    attaque:10, 
    defense:10
);

$combat = new Combat(
    $tortipouss,
    $bulbizarre
);

$combat->lancerCombat();

?>