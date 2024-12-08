<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Pokémon</title>
    <link href="../assets/css/style.css" type="text/css" media="all">
</head>
<body class="p-5">
    <h1 class="text-3xl mb-4">Choisissez vos Pokémon et lancez le combat</h1>

    <form action="index.php" method="POST" class="space-y-4">
        <div class="flex space-x-10">
            <div>
                <h2 class="text-xl mb-2">Choisissez votre Pokémon 1 :</h2>
                <div class="space-y-4">
                    <label>
                        <input type="radio" name="pokemon1" value="PokemonFeu" class="hidden peer" />
                        <img src="../assets/img/Salamèche.png" alt="Salamèche" class="w-32 cursor-pointer pokemon-image peer-checked:border-blue-500" />
                    </label>
                    <label>
                        <input type="radio" name="pokemon1" value="PokemonEau" class="hidden peer" />
                        <img src="../assets/img/Carapuce.png" alt="Carapuce" class="w-32 cursor-pointer pokemon-image peer-checked:border-blue-500" />
                    </label>
                    <label>
                        <input type="radio" name="pokemon1" value="PokemonPlante" class="hidden peer" />
                        <img src="../assets/img/Bulbizarre.png" alt="Bulbizarre" class="w-32 cursor-pointer pokemon-image peer-checked:border-blue-500" />
                    </label>
                </div>
            </div>

            <div>
                <h2 class="text-xl mb-2">Choisissez votre Pokémon 2 :</h2>
                <div class="space-y-4">
                    <label>
                        <input type="radio" name="pokemon2" value="PokemonFeu" class="hidden peer" />
                        <img src="../assets/img/Salamèche.png" alt="Salamèche" class="w-32 cursor-pointer pokemon-image peer-checked:border-blue-500" />
                    </label>
                    <label>
                        <input type="radio" name="pokemon2" value="PokemonEau" class="hidden peer" />
                        <img src="../assets/img/Carapuce.png" alt="Carapuce" class="w-32 cursor-pointer pokemon-image peer-checked:border-blue-500" />
                    </label>
                    <label>
                        <input type="radio" name="pokemon2" value="PokemonPlante" class="hidden peer" />
                        <img src="../assets/img/Bulbizarre.png" alt="Bulbizarre" class="w-32 cursor-pointer pokemon-image peer-checked:border-blue-500" />
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="button mt-4">Lancer le combat</button>
    </form>

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['pokemon1']) && isset($_POST['pokemon2'])) {
            // On récupère les Pokémon choisis
            $pokemon1_type = $_POST['pokemon1'];
            $pokemon2_type = $_POST['pokemon2'];

            require_once '../classes/PokemonFeu.php';
            require_once '../classes/PokemonEau.php';
            require_once '../classes/PokemonPlante.php';
            require_once '../classes/Combat.php';

            if ($pokemon1_type === 'PokemonFeu') {
                $pokemon1 = new PokemonFeu("Salamèche", 100, 30, 10);
            } elseif ($pokemon1_type === 'PokemonEau') {
                $pokemon1 = new PokemonEau("Carapuce", 100, 25, 12);
            } elseif ($pokemon1_type === 'PokemonPlante') {
                $pokemon1 = new PokemonPlante("Bulbizarre", 100, 20, 15);
            }

            if ($pokemon2_type === 'PokemonFeu') {
                $pokemon2 = new PokemonFeu("Salamèche", 100, 30, 10);
            } elseif ($pokemon2_type === 'PokemonEau') {
                $pokemon2 = new PokemonEau("Carapuce", 100, 25, 12);
            } elseif ($pokemon2_type === 'PokemonPlante') {
                $pokemon2 = new PokemonPlante("Bulbizarre", 100, 20, 15);
            }

            $combat = new Combat($pokemon1, $pokemon2);
            $combat->demarrerCombat();

            header('Location: combat.php');
            exit(); 
        } else {
            echo "<p style='color: red;'>Erreur : Les Pokémon n'ont pas été sélectionnés.</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

</body>
</html>
