<?php 

session_start();

require_once 'class/Pokemon.php';
require_once 'class/Combat.php';

$pokemon1 = unserialize($_SESSION['player1']);
$pokemon2 = unserialize($_SESSION['player2']);

if (isset($_POST['attaque']) && $_POST['attaque'] === 'attaque_normale') {
    if ($pokemon1->utiliserCapaciteNormale($pokemon2)) {
        $_SESSION['player2'] = serialize($pokemon2);
        
        if ($pokemon2->estKO()) {
            $_SESSION['fight_message'] = serialize("{$pokemon2->getNom()} est KO.");

            $fight = unserialize($_SESSION['fight']);
            $fight->setTurn(0);
            $_SESSION['fight'] = serialize($fight);

            header('Location: combat.php');
            exit();
        } else {
            $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} utilise {$pokemon1->getAttaqueNormale()->getNom()} et met {$pokemon1->getAttaqueNormale()->getDegats()} dégâts à {$pokemon2->getNom()}.");
        }

    } else {
        $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} a raté son attaque !");
    }
    
    $fight = unserialize($_SESSION['fight']);
    $fight->setTurn(2);
    $_SESSION['fight'] = serialize($fight);
    
    header('Location: combat.php');
    exit();

} else if (isset($_POST['attaque']) && $_POST['attaque'] === 'attaque_speciale') {
    if ($pokemon1->utiliserCapaciteSpeciale($pokemon2)) {
        $_SESSION['player2'] = serialize($pokemon2);
        
        if ($pokemon2->estKO()) {
            $_SESSION['fight_message'] = serialize("{$pokemon2->getNom()} est KO.");
            
            $fight = unserialize($_SESSION['fight']);
            $fight->setTurn(0);
            $_SESSION['fight'] = serialize($fight);

            header('Location: combat.php');
            exit();
        } else {
            $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} utilise {$pokemon1->getAttaqueSpeciale()->getNom()} et met {$pokemon1->getAttaqueSpeciale()->getDegats()} dégâts à {$pokemon2->getNom()}.");
        }
    } else {
        $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} a raté son attaque !");
    }
    
    $fight = unserialize($_SESSION['fight']);
    $fight->setTurn(2);
    $_SESSION['fight'] = serialize($fight);

    header('Location: combat.php');
    exit();
}

if (isset($_POST['soin']) && $_POST['soin'] === 'soin') {
    
    if ($pokemon1->getPointsDeVie() >= $pokemon1->getMaxPointsDeVie()) {
        $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} a déjà toute sa vie.");

        header('Location: combat.php');
        exit();
    }

    $pokemon1->soigner();
    $_SESSION['player1'] = serialize($pokemon1);
    $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} se soigne.");

    // Optionnel : Ajouter limite de soin
    // --------------------------
    header('Location: combat.php');
    exit();
}

if (isset($_POST['suivant']) && $_POST['suivant'] === 'suivant') {

    if ($pokemon2->utiliserCapaciteNormale($pokemon1)) {
        $_SESSION['player1'] = serialize($pokemon1);
        
        if ($pokemon1->estKO()) {
            $_SESSION['fight_message'] = serialize("{$pokemon1->getNom()} est KO.");

            $fight = unserialize($_SESSION['fight']);
            $fight->setTurn(0);
            $_SESSION['fight'] = serialize($fight);

            header('Location: combat.php');
            exit();
        } else {
            $_SESSION['fight_message'] = serialize("{$pokemon2->getNom()} utilise {$pokemon2->getAttaqueNormale()->getNom()} et met {$pokemon2->getAttaqueNormale()->getDegats()} dégâts à {$pokemon1->getNom()}.");
        }

    } else {
        $_SESSION['fight_message'] = serialize("{$pokemon2->getNom()} a raté son attaque !");
    }
    
    $fight = unserialize($_SESSION['fight']);
    $fight->setTurn(1);
    $_SESSION['fight'] = serialize($fight);
    
    header('Location: combat.php');
    exit();
}