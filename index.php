<?php
$json = file_get_contents('./datas/pokemons.json');
$pokemonsData = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pokemon - PHP</title>
</head>
<body>
    <div class="flex flex-col gap-8 items-center bg-emerald-50 min-h-svh">
        <h1 class="pokemon-font text-6xl text-center my-12 text-gray-950">Choisissez vos Pokemons</h1>
        <form  
            method="post"
            action="combat.php"
            class="flex flex-col justify-center items-center gap-12" 
            id="pokemons_form"
        >
            <div class="flex items-center justify-center gap-12">
                <div class="flex flex-col gap-10 bg-white rounded-lg p-12 border border-gray-200">
                    <h2 class="pokemon-font text-4xl text-center text-gray-800">
                        Joueur 1
                    </h2>
                    <div class="grid grid-cols-3 gap-6">
                        <?php foreach ($pokemonsData as $pokemon) { ?>
                            <label for="p1-<?= $pokemon['slug'] ?>" class="w-40 h-40 bg-emerald-800 bg-gray-50 hover:bg-gray-200 transition-colors cursor-pointer rounded-md 
                                has-[:checked]:bg-emerald-100 has-[:checked]:border has-[:checked]:border-emerald-800"
                            >
                                <img 
                                    src="<?= $pokemon['image']["front"] ?>" 
                                    alt="" 
                                    class="w-full h-full object-contain"
                                >
                                <input type="radio" id="p1-<?= $pokemon['slug'] ?>" name="player1" value="<?= $pokemon['slug'] ?>" class="hidden">
                            </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="flex flex-col gap-10 bg-white rounded-lg p-12 border border-gray-200">
                    <h2 class="pokemon-font text-4xl text-center text-gray-800">
                        Joueur 2
                    </h2>
                    <div class="grid grid-cols-3 gap-6">
                        <?php foreach ($pokemonsData as $pokemon) { ?>
                            <label for="p2-<?= $pokemon['slug'] ?>" class="w-40 h-40 bg-emerald-800 bg-gray-50 hover:bg-gray-200 transition-colors cursor-pointer rounded-md 
                                has-[:checked]:bg-emerald-100 has-[:checked]:border has-[:checked]:border-emerald-800"
                            >
                                <img 
                                    src="<?= $pokemon['image']["front"] ?>" 
                                    alt="<?= $pokemon['nom'] ?> image" 
                                    class="w-full h-full object-contain"
                                >
                                <input type="radio" id="p2-<?= $pokemon['slug'] ?>" name="player2" value="<?= $pokemon['slug'] ?>" class="hidden">
                            </label>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center gap-2">
                <?php if (isset($_GET['error']) && $_GET['error'] === 'missing_pokemon') { ?>
                    <p id="error-message" class="text-center text-rose-500">
                        Veuillez choisir un Pokemon pour chaque joueur.
                    </p>
                <?php } ?>
                <button 
                    type="submit" 
                    class="inline-flex w-fit bg-emerald-800 px-4 py-3 rounded-xl text-white font-semibold
                     text-xl hover:bg-emerald-900 transition-colors cursor-pointer">
                    Lancer le combat
                </button>
            </div>
        </form>
    </div>

    <!-- <script src="./js/script.js"></script> -->
</body>
</html>