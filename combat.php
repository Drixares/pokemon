<?php
session_start();

require_once('./class/Pokemon.php');
require_once('./functions/start-fight.php');
require_once('./class/Combat.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'start') {
    startFight();
}

$pokemon1 = unserialize($_SESSION['player1']);
$pokemon2 = unserialize($_SESSION['player2']);
$fight_message = unserialize($_SESSION['fight_message']);
$fight = unserialize($_SESSION['fight']);
$winner = null;

if ($fight->getTurn() == 0) {
    $winner = $fight->determinerWinner($pokemon1, $pokemon2);
}

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
                    <div class="flex items-center gap-2">
                        <div class="w-40 h-2 bg-gray-400 rounded-full overflow-hidden">
                            <div 
                                class="h-2 bg-emerald-600 rounded-full" 
                                style="width: <?= $pokemon1->getPointsDeVie() > 0 
                                    ? $pokemon1->getPointsDeVie() * 100 / $pokemon1->getMaxPointsDeVie() 
                                    : 0 ?>%"
                            ></div>
                        </div>
                        <span class="text-sm text-slate-600">
                            <?= $pokemon1->getPointsDeVie() > 0 
                                ? $pokemon1->getPointsDeVie() 
                                : 0 ?> / <?= $pokemon1->getMaxPointsDeVie() ?>
                        </span>
                    </div>
                </div>
                <div class="size-60 overflow-hidden">
                    <img 
                        src="<?= $pokemon1->getImage("back") ?>" 
                        alt="<?= $pokemon1->getNom() ?>"
                        class="w-full h-full object-contain"
                    >
                </div>
                <?php if ($fight->getTurn() == 1) { ?>
                    <form action="traitement.php" method="post">
                        <button 
                            type="submit"
                            class="inline-flex w-fit bg-emerald-800 p-2 bg-emerald-600 hover:bg-emerald-700 rounded-md text-slate-50 font-medium transition-colors cursor-pointer"
                        >
                            Soigner
                        </button>
                        <input type="hidden" name="soin" value="soin">
                    </form>
                <?php } ?>
            </div>
            <div class="flex flex-col items-center justify-center -translate-y-10 gap-3 w-full">
                <div class="flex flex-col gap-2">
                    <span><?= $pokemon2->getNom() ?> (p2)</span>
                    <div class="flex items-center gap-2">
                        <div class="w-40 h-2 bg-gray-400 rounded-full overflow-hidden">
                            <div 
                                class="h-2 bg-emerald-600 rounded-full" 
                                style="width: <?= $pokemon2->getPointsDeVie() > 0 
                                    ? $pokemon2->getPointsDeVie() * 100 / $pokemon2->getMaxPointsDeVie() 
                                    : 0 ?>%"
                            ></div>
                        </div>
                        <span class="text-sm text-slate-600">
                            <?= $pokemon2->getPointsDeVie() > 0 
                                ? $pokemon2->getPointsDeVie() 
                                : 0 ?> / <?= $pokemon2->getMaxPointsDeVie() ?>
                        </span>
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
                <p><?= $fight_message ?></p>
            </div>
            <div class="w-full flex flex-col items-center jutify-center gap-6 bg-white border-l border-r border-slate-200 p-8">
                <?php if ($fight->getTurn() == 1) { ?>    
                    <p class="font-bold text-2xl text-slate-950 ">
                        Chosis ton attaque :
                    </p>
                    <div class="flex items-center gap-3">
                        <form action="traitement.php" method="post">
                            <button 
                                type="submit" 
                                class="inline-flex w-fit bg-emerald-800 p-4 bg-slate-100 rounded-md text-slate-800 font-medium
                                text-lg hover:bg-slate-200 transition-colors cursor-pointer"
                            >
                                <?= $pokemon1->getAttaqueNormale()->getNom() ?>
                            </button>
                            <input type="hidden" name="attaque" value="attaque_normale">
                        </form>
                        <form action="traitement.php" method="post">
                            <button 
                                type="submit" 
                                class="inline-flex w-fit bg-emerald-800 p-4 bg-slate-100 rounded-md text-slate-800 font-medium
                                text-lg hover:bg-slate-200 transition-colors cursor-pointer"
                            >
                                <?= $pokemon1->getAttaqueSpeciale()->getNom() ?>
                            </button>
                            <input type="hidden" name="attaque" value="attaque_speciale">
                        </form>
                    </div>
                <?php } else if ($fight->getTurn() == 2) { ?>
                    <p class="font-semibold text-xl text-slate-950">
                        C'est au tour de <?= $pokemon2->getNom() ?> de jouer.
                    </p>
                    <form action="traitement.php" method="post">
                        <button 
                            type="submit"
                            class="inline-flex w-fit bg-emerald-800 py-2 px-4 bg-slate-100 rounded-md text-slate-800 font-medium
                                text-lg hover:bg-slate-200 transition-colors cursor-pointer"
                        >
                            Suivant
                        </button>
                        <input type="hidden" name="suivant" value="suivant">
                    </form>
                <?php } ?>
            </div>
        </div>

        <?php if ($winner) { ?>
            <div class="fixed max-w-3xl w-full left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20 bg-white border border-slate-200
             rounded-lg flex flex-col items-center justify-center gap-4 max-h-60 h-full">
                <p class="text-2xl font-semibold text-slate-950">
                    <?= $winner->getNom() ?> a gagné la partie.
                </p>
                <form action="logout.php" method="post">
                    <button 
                        type="submit" 
                        class="inline-flex w-fit bg-emerald-800 p-2 bg-emerald-600 hover:bg-emerald-700 rounded-md text-slate-50 font-medium
                         transition-colors cursor-pointer"
                    >
                        Retourner à l'accueil
                    </button>
                    <input type="hidden" name="action" value="logout">
                </form>
            </div>
            <div class="fixed inset-0 bg-white/60 z-10"></div>
        <?php } ?>

    </div>
</body>
</html>