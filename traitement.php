<?php 

require_once 'class/Pokemon.php';
require_once 'class/Attaque.php';

$pokemon1 = unserialize($_SESSION['player1']);
$pokemon2 = unserialize($_SESSION['player2']);

if (isset($_POST['attaque']) && $_POST['attaque'] === 'attaque_normale') {
    $pokemon1->attaquer($pokemon2);
} else if (isset($_POST['attaque']) && $_POST['attaque'] === 'attaque_speciale') {
    $pokemon1->utiliserCapaciteSpeciale($pokemon2);
}

?>