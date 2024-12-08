<?php

trait Soins {
    public function soigner(): void {
        $this->pointsDeVie = 100; // Remet à un maximum de PV
        echo "{$this->nom} est soigné à ses PV maximum.<br>";
    }
}
