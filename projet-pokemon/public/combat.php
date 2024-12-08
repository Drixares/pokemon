<?php
session_start();

// Vérifier si un combat a déjà commencé
if (!isset($_SESSION['pokemon1']) || !isset($_SESSION['pokemon2'])) {
    header('Location: index.php');
    exit();
}

$pokemon1 = $_SESSION['pokemon1'];
$pokemon2 = $_SESSION['pokemon2'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tour de combat : l'un des Pokémon attaque
    if (isset($_POST['attacker'])) {
        $attacker = $_POST['attacker'] == 1 ? $pokemon1 : $pokemon2;
        $defender = $_POST['attacker'] == 1 ? $pokemon2 : $pokemon1;

        // Attaque du Pokémon
        $attacker->attaquer($defender);
        if (!$defender->estKO()) {
            // Utilisation de la capacité spéciale après l'attaque
            $attacker->capaciteSpeciale($defender);
        }
    }
    
    // Vérifier si le combat est terminé
    if ($pokemon1->estKO() || $pokemon2->estKO()) {
        $gagnant = $pokemon1->estKO() ? $pokemon2 : $pokemon1;
        echo "<p>" . $gagnant->getNom() . " a gagné le combat !</p>";
        session_destroy();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat Pokémon</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés */
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body class="p-5">
    <h1 class="text-3xl mb-4">Combat Pokémon</h1>
    <div class="mb-4">
        <p><strong><?= $pokemon1->getNom() ?> (HP: <?= $pokemon1->getHp() ?>)</strong></p>
        <p><strong><?= $pokemon2->getNom() ?> (HP: <?= $pokemon2->getHp() ?>)</strong></p>
    </div>

    <form action="combat.php" method="POST">
        <button type="submit" name="attacker" value="1" class="btn btn-primary">Attaquer avec <?= $pokemon1->getNom() ?></button>
        <button type="submit" name="attacker" value="2" class="btn btn-primary">Attaquer avec <?= $pokemon2->getNom() ?></button>
    </form>
</body>
</html>
