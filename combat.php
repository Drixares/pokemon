<?php
session_start();

require_once('./class/Pokemon.php');

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
    'feu' => new PokemonFeu($player1Data['nom'], $player1Data['hp'], $player1Data['hp'], $player1Data['attaque'], $player1Data['image']),
    'eau' => new PokemonEau($player1Data['nom'], $player1Data['hp'], $player1Data['hp'], $player1Data['attaque'], $player1Data['image']),
    'plante' => new PokemonPlante($player1Data['nom'], $player1Data['hp'], $player1Data['hp'], $player1Data['attaque'], $player1Data['image'])
};

$pokemon2 = match($player2Data['type']) {
    'feu' => new PokemonFeu($player2Data['nom'], $player2Data['hp'], $player2Data['hp'], $player2Data['attaque'], $player2Data['image']),
    'eau' => new PokemonEau($player2Data['nom'], $player2Data['hp'], $player2Data['hp'], $player2Data['attaque'], $player2Data['image']),
    'plante' => new PokemonPlante($player2Data['nom'], $player2Data['hp'], $player2Data['hp'], $player2Data['attaque'], $player2Data['image'])
};

// Store in session
$_SESSION['player1'] = serialize($pokemon1);
$_SESSION['player2'] = serialize($pokemon2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokemon</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex flex-col items-center justify-between gap-8 bg-emerald-50 min-h-svh">
        <h1 class="pokemon-font text-6xl text-center my-12 text-gray-950">
            C'est parti !
        </h1>

        <div class="flex items-center justify-between max-w-5xl w-full">
            <div class="flex flex-col items-center justify-center translate-y-10 gap-3 w-full">
                <div class="flex flex-col gap-2">
                    <span><?= $pokemon1->getNom() ?> (p1)</span>
                    <div class="w-40 h-2 bg-gray-400 rounded-full overflow-hidden">
                        <div 
                            class="h-2 bg-emerald-600 rounded-full" 
                            style="width: <?= $pokemon1->getPointsDeVie() * 100 / $pokemon1->getMaxPointsDeVie() ?>%"
                        ></div>
                    </div>
                </div>
                <div class="size-60 overflow-hidden">
                    <img 
                        src="<?= $pokemon1->getImage("back") ?>" 
                        alt="<?= $pokemon1->getNom() ?>"
                        class="w-full h-full object-contain"
                    >
                </div>
            </div>
            <div class="flex flex-col items-center justify-center -translate-y-10 gap-3 w-full">
                <div class="flex flex-col gap-2">
                    <span><?= $pokemon2->getNom() ?> (p2)</span>
                    <div class="w-40 h-2 bg-gray-400 rounded-full overflow-hidden">
                        <div 
                            class="h-2 bg-emerald-600 rounded-full" 
                            style="width: <?= $pokemon2->getPointsDeVie() * 100 / $pokemon2->getMaxPointsDeVie() ?>%"
                        ></div>
                    </div>
                </div>
                <div class="size-60 overflow-hidden">
                    <img 
                        src="<?= $pokemon2->getImage("front") ?>" 
                        alt="<?= $pokemon2->getNom() ?>"
                        class="w-full h-full object-contain"
                    >
                </div>
            </div>
        </div>

        <div class="max-w-3xl w-full flex flex-col">
            <div class="p-4 border border-slate-200 rounded-t-lg bg-white">
                <p>Un pokemon sauvage est apparu !</p>
            </div>
            <div class="w-full flex flex-col items-center jutify-center gap-6 bg-white border-l border-r border-slate-200 p-8">
                <p class="font-bold text-2xl text-slate-950 ">
                    Chosis ton attaque :
                </p>
                <div class="flex items-center gap-3">
                    <form action="traitement.php" method="post">
                        <button 
                            type="submit" 
                            class="inline-flex w-fit bg-emerald-800 p-4 bg-slate-100 rounded-md text-slate-800 font-medium
                             text-xl hover:bg-slate-200 transition-colors cursor-pointer"
                        >
                            Attaque Normale
                        </button>
                        <input type="hidden" name="attaque" value="attaque_normale">
                    </form>
                    <form action="traitement.php" method="post">
                        <button 
                            type="submit" 
                            class="inline-flex w-fit bg-emerald-800 p-4 bg-slate-100 rounded-md text-slate-800 font-medium
                             text-xl hover:bg-slate-200 transition-colors cursor-pointer"
                        >
                            Attaque Speciale
                        </button>
                        <input type="hidden" name="attaque" value="attaque_speciale">
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>