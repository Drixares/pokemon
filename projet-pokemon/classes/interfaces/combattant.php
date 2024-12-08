<?php

interface Combattant {
    public function seBattre(Pokemon $adversaire): void;
    public function utiliserAttaqueSpeciale(Pokemon $adversaire): void;
}
