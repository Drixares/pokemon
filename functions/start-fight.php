<?php

session_start();

function startFight() {
    $player1 = $_POST['player1'];
    $player2 = $_POST['player2'];

    if (!isset($player1) || !isset($player2)) {
        header('Location: index.php?error=missing_pokemon');
        exit();
    }
    
    $json = file_get_contents('./datas/pokemons.json');
    $pokemonsData = json_decode($json, true);

    $player1Data = $pokemonsData[array_search($player1, array_column($pokemonsData, 'slug'))];
    $player2Data = $pokemonsData[array_search($player2, array_column($pokemonsData, 'slug'))];
    
    $pokemon1 = match($player1Data['type']) {
        'feu' => new PokemonFeu($player1Data['nom'], $player1Data['hp'], $player1Data['hp'], $player1Data['image'], $player1Data['capacite_normale']),
        'eau' => new PokemonEau($player1Data['nom'], $player1Data['hp'], $player1Data['hp'], $player1Data['image'], $player1Data['capacite_normale']),
        'plante' => new PokemonPlante($player1Data['nom'], $player1Data['hp'], $player1Data['hp'], $player1Data['image'], $player1Data['capacite_normale'])
    };
    
    $pokemon2 = match($player2Data['type']) {
        'feu' => new PokemonFeu($player2Data['nom'], $player2Data['hp'], $player2Data['hp'], $player2Data['image'], $player2Data['capacite_normale']),
        'eau' => new PokemonEau($player2Data['nom'], $player2Data['hp'], $player2Data['hp'], $player2Data['image'], $player2Data['capacite_normale']),
        'plante' => new PokemonPlante($player2Data['nom'], $player2Data['hp'], $player2Data['hp'], $player2Data['image'], $player2Data['capacite_normale'])
    };

    $fight = new Combat($pokemon1, $pokemon2);
    $fight->lancerCombat();

    // Store in session
    $_SESSION['player1'] = serialize($pokemon1);
    $_SESSION['player2'] = serialize($pokemon2);
    $_SESSION['fight'] = serialize($fight);
    $_SESSION['fight_message'] = serialize("Un ". $pokemon2->getNom() . " sauvage est apparu !");
}

?>